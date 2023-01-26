<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use App\Models\Inquiry;
use App\Models\ProfileImage;
use App\Models\PetsitterServices;
use App\Models\Service;
use App\Models\City;
use App\Models\Opinion;
use App\Mail\InquiryAnswerMail;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserChangeDataMail;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function edit(Request $request)
    {
        $user = $request->user();

        // ProfileImage
        $profile_image = ProfileImage::where('user_id', $user->id)->first();
        if($profile_image) {
            $profile_image_path = $profile_image->path;
        } else {
            $profile_image_path = null;
        }

        // Services
        $petsitter_services = PetsitterServices::where('petsitter_id', $user->id)->get();
        $service_ids = $petsitter_services->pluck('service_id')->toArray();
        $user_services = Service::whereIn('id', $service_ids)->get();
        $services = Service::all();
        $services = $services->diff($user_services);

        // Cities
        $cities = City::all();
        $city = City::find($user->city_id);
        $other_cities = City::where('id', '!=', $user->city_id)->get();

        return view('profile.edit', [
            'services' => $services,
            'user' => $user,
            'user_services' => $user_services,
            'cities' => $cities,
            'profile_image_url' => $profile_image_path,
            'city' => $city,
            'other_cities' => $other_cities
        ]);
    }

    /**
     * Update the user's profile information.
     *
     * @param  \App\Http\Requests\ProfileUpdateRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileUpdateRequest $request)
    {
        $request->user()->fill($request->validated());

        // dd($request->get('profile_description'));

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $profile_image_file = $request->file('profile_image');

        if($profile_image_file != null) {
            $file_path = $profile_image_file->storeAs('public/profile_images', 'profile_picture-' . $request->user()->id . '.jpg');
            $file_name = $request->file('profile_image')->getClientOriginalName();

            $existing_profile_image = ProfileImage::where('user_id', $request->user()->id)->first();

            if($existing_profile_image) {
                $existing_profile_image->delete();
            }
    
            $profile_image = new ProfileImage;
            $profile_image->name = $file_name;
            $profile_image->path = $file_path;
            $profile_image->user_id = $request->user()->id;
            $profile_image->save();
        }

        $request->user()->profile_description = $request->get('profile_description');
        $request->user()->city_id = $request->get('city_id');

        $services = $request->get('services');
        $user_services = $request->get('user_services');

        if($request->user()->role == 'Petsitter' && $services) {
            foreach($services as $service) {
                $petsitter_service = new PetsitterServices;
                $petsitter_service->petsitter_id = $request->user()->id;
                $petsitter_service->service_id = $service;
                $petsitter_service->save();
            }
        }

        if($request->user()->role == 'Petsitter' && $user_services) {
            foreach($user_services as $user_service) {
                $petsitter_service = PetsitterServices::where('petsitter_id', $request->user()->id)->where('service_id', $user_service)->get();
                $petsitter_service->each->delete();
            }
        }

        $request->user()->status = 'Draft';

        $admins = User::where('role', 'Admin')->get();
        $user = $request->user();
        $url = url('/users/' . $user->id);

        foreach($admins as $admin) {
            Mail::to($admin->email)->send(new UserChangeDataMail($user->name, $user->email, $url));
        }

        $request->user()->save();
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * Display list of users.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request) {

        $users = User::all() ?? [];
        $inquiries = Inquiry::all() ?? [];
        $latestUser = User::get()->last();
        $latestInquiries = Inquiry::latest()->take(5)->get() ?? [];
        $latestInquiryUser = Inquiry::get()->last() ? User::find(Inquiry::get()->last()->petsitter_id) : null;
        $latestOpinions = Opinion::latest()->take(5)->get() ?? [];
        $latestOpinionUser = Inquiry::get()->last() ? User::find(Inquiry::get()->last()->petsitter_id) : null;

        $customerInquiries = Inquiry::where('customer_id', auth()->user()->id) ?? [];
        $customerInquiriesNumber = $customerInquiries->count();
        $customerOpinions = Opinion::where('customer_id', auth()->user()->id) ?? [];
        $customerOpinionsNumber = $customerOpinions->count();

        $petsitterInquiries = Inquiry::where('petsitter_id', auth()->user()->id) ?? [];
        $petsitterInquiriesNumber = $petsitterInquiries->count();
        $petsitterOpinions = Opinion::where('petsitter_id', auth()->user()->id) ?? [];
        $petsitterOpinionsNumber = $petsitterOpinions->count();

        return view('dashboard', [
            'users' => $users,
            'inquiries' => $inquiries,
            'latestUser' => $latestUser,
            'latestInquiries' => $latestInquiries,
            'latestInquiryUser' => $latestInquiryUser,
            'latestOpinions' => $latestOpinions,
            'latestOpinionUser' => $latestOpinionUser,
            'customerInquiriesNumber' => $customerInquiriesNumber,
            'customerInquiries' => $customerInquiries,
            'customerOpinionsNumber' => $customerOpinionsNumber,
            'petsitterInquiries' => $petsitterInquiries,
            'petsitterInquiriesNumber' => $petsitterInquiriesNumber,
            'petsitterOpinions' => $petsitterOpinions,
            'petsitterOpinionsNumber' => $petsitterOpinionsNumber
        ]);
    }

    /**
     * Display list of customer's opinions.
     *
     * @return \Illuminate\View\View
     */
    public function customer_opinions() {
        $opinions = Opinion::where('customer_id', auth()->user()->id)->latest()->get() ?? [];

        return view('customer_opinions.index', [
            'opinions' => $opinions 
        ]);
    }

    /**
     * Display list of petsitter's opinions.
     *
     * @return \Illuminate\View\View
     */
    public function petsitter_opinions() {
        $opinions = Opinion::where('petsitter_id', auth()->user()->id)->latest()->get() ?? [];

        return view('petsitter_opinions.index', [
            'opinions' => $opinions 
        ]);
    }

    /**
     * Display the customer's specified opinion.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function customer_opinion($id)
    {
        $opinion = Opinion::find($id);
        $petsitter = User::find($opinion->petsitter_id);
        $customer = User::find($opinion->customer_id);

        return view('customer_opinions.show', [
            'opinion' => $opinion,
            'petsitter' => $petsitter,
            'customer' => $customer
        ]);
    }

    /**
     * Display the petsitter's specified opinion.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function petsitter_opinion($id)
    {
        $opinion = Opinion::find($id);
        $petsitter = User::find($opinion->petsitter_id);
        $customer = User::find($opinion->customer_id);

        return view('petsitter_opinions.show', [
            'opinion' => $opinion,
            'petsitter' => $petsitter,
            'customer' => $customer
        ]);
    }

    /**
     * Display list of customer's inquiries.
     *
     * @return \Illuminate\View\View
     */
    public function customer_inquiries() {
        $inquiries = Inquiry::where('customer_id', auth()->user()->id)->latest()->get() ?? [];

        return view('customer_inquiries.index', [
            'inquiries' => $inquiries 
        ]);
    }

    /**
     * Display list of petsitter's inquiries.
     *
     * @return \Illuminate\View\View
     */
    public function petsitter_inquiries() {
        $inquiries = Inquiry::where('petsitter_id', auth()->user()->id)->latest()->get() ?? [];

        return view('petsitter_inquiries.index', [
            'inquiries' => $inquiries 
        ]);
    }

    /**
     * Display the customer's specified inquiry.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function customer_inquiry($id)
    {
        $inquiry = Inquiry::find($id);
        $petsitter = User::find($inquiry->petsitter_id);
        $customer = User::find($inquiry->customer_id);
        $city = City::find($inquiry->city_id);
        $service = City::find($inquiry->service_id);

        return view('customer_inquiries.show', [
            'inquiry' => $inquiry,
            'petsitter' => $petsitter,
            'customer' => $customer,
            'city' => $city,
            'service' => $service
        ]);
    }

    /**
     * Display the petsitter's specified inquiry.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function petsitter_inquiry($id)
    {
        $inquiry = Inquiry::find($id);
        $petsitter = User::find($inquiry->petsitter_id);
        $customer = User::find($inquiry->customer_id);
        $city = City::find($inquiry->city_id);
        $service = City::find($inquiry->service_id);

        return view('petsitter_inquiries.show', [
            'inquiry' => $inquiry,
            'petsitter' => $petsitter,
            'customer' => $customer,
            'city' => $city,
            'service' => $service
        ]);
    }

    /**
     * Answer to inquiry as petsitter.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function answer_to_inquiry($id)
    {
        $inquiry = Inquiry::find($id);
        $petsitter = User::find($inquiry->petsitter_id);
        $customer = User::find($inquiry->customer_id);
        $answers = ['Approved', 'Rejected'];

        return view('petsitter_inquiries.answer', [
            'inquiry' => $inquiry,
            'petsitter' => $petsitter,
            'customer' => $customer,
            'answers' => $answers
        ]);
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function send_answer(Request $request, $id) 
    {
        $inquiry = Inquiry::where('id', $id)->first();

        $inquiry->status = $request['answer'];
        $inquiry->feedback_message = $request['feedback_message'];
        $inquiry->save();

        $url = url('/customer_inquiries/' . $inquiry->id);

        $customer = User::find($inquiry->customer_id);
        $petsitter = User::find($inquiry->petsitter_id);

        Mail::to($customer->email)->send(new InquiryAnswerMail($petsitter->name, $petsitter->email, $url));

        return redirect()->route('petsitter_inquiry', ['id' => $inquiry->id])->with('success');
    }

}
