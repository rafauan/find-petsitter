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

        if($request->user()->role == 'Petsitter') {
            $user = User::find($request->user()->id);

            // Validation for required fields (and using some regex to validate our numeric value)
            $request->validate(
                [
                    'name' => 'required',
                    'email' => 'required|email|unique:users,email,' . $user->id,
                    'role' => 'required',
                    'status' => 'required',
                    // 'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
                ],
                [   
                    'name.required' => 'Please Provide Your Email Address For Better Communication, Thank You',
                    'email.unique' => 'Sorry, this email address is already used by another user. Please try with different one',
                    'email.email' => 'Please try with correct email address'
                ]
            ); 
    
            $user->name = $request->get('name');
            $user->email = $request->get('email');
            $user->role = $request->get('role');
            $user->status = $request->get('status');
            $user->city_id = $request->get('city_id');
            $user->profile_description = $request->get('profile_description');
            $user->save();
    
            $profile_image_file = $request->file('profile_image');
    
            if($profile_image_file != null) {
                $file_path = $profile_image_file->storeAs('public/profile_images', 'profile_picture-' . $user->id . '.jpg');
                $file_name = $request->file('profile_image')->getClientOriginalName();
    
                $existing_profile_image = ProfileImage::where('user_id', $user->id)->first();
    
                if($existing_profile_image) {
                    $existing_profile_image->delete();
                }
        
                $profile_image = new ProfileImage;
                $profile_image->name = $file_name;
                $profile_image->path = $file_path;
                $profile_image->user_id = $user->id;
                $profile_image->save();
            }
    
            $services = $request->get('services');
            $user_services = $request->get('user_services');
    
            if($user->role == 'Petsitter' && $services) {
                foreach($services as $service) {
                    $petsitter_service = new PetsitterServices;
                    $petsitter_service->petsitter_id = $user->id;
                    $petsitter_service->service_id = $service;
                    $petsitter_service->save();
                }
            }
    
            if($user->role == 'Petsitter' && $user_services) {
                foreach($user_services as $user_service) {
                    $petsitter_service = PetsitterServices::where('petsitter_id', $user->id)->where('service_id', $user_service)->get();
                    $petsitter_service->each->delete();
                }
            }
        } else {
            $request->user()->save();
        }

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Update the user's profile information.
     *
     * @param  \App\Http\Requests\ProfileUpdateRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update_petsitter_info(ProfileUpdateRequest $request)
    {
        $user = User::find($request->user()->id);

        // Validation for required fields (and using some regex to validate our numeric value)
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'role' => 'required',
                'status' => 'required',
                // 'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
            ],
            [   
                'name.required' => 'Please Provide Your Email Address For Better Communication, Thank You',
                'email.unique' => 'Sorry, this email address is already used by another user. Please try with different one',
                'email.email' => 'Please try with correct email address'
            ]
        ); 

        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->role = $request->get('role');
        $user->status = $request->get('status');
        $user->city_id = $request->get('city_id');
        $user->profile_description = $request->get('profile_description');
        $user->save();

        $profile_image_file = $request->file('profile_image');

        if($profile_image_file != null) {
            $file_path = $profile_image_file->storeAs('public/profile_images', 'profile_picture-' . $user->id . '.jpg');
            $file_name = $request->file('profile_image')->getClientOriginalName();

            $existing_profile_image = ProfileImage::where('user_id', $user->id)->first();

            if($existing_profile_image) {
                $existing_profile_image->delete();
            }
    
            $profile_image = new ProfileImage;
            $profile_image->name = $file_name;
            $profile_image->path = $file_path;
            $profile_image->user_id = $user->id;
            $profile_image->save();
        }

        $services = $request->get('services');
        $user_services = $request->get('user_services');

        if($user->role == 'Petsitter' && $services) {
            foreach($services as $service) {
                $petsitter_service = new PetsitterServices;
                $petsitter_service->petsitter_id = $user->id;
                $petsitter_service->service_id = $service;
                $petsitter_service->save();
            }
        }

        if($user->role == 'Petsitter' && $user_services) {
            foreach($user_services as $user_service) {
                $petsitter_service = PetsitterServices::where('petsitter_id', $user->id)->where('service_id', $user_service)->get();
                $petsitter_service->each->delete();
            }
        }

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

        // $user = User::all();
        // $inquiries = Inquiry::all();
        // $latestUser = User::get()->last();
        // $latestInquiries = Inquiry::latest()->take(5)->get();

        return view('dashboard', [
            // 'users' => User::latest()->filter(request(['tag', 'search']))->paginate(4)
            'users' => User::all(),
            'inquiries' => Inquiry::all(),
            'latestUser' => User::get()->last(),
            'latestInquiries' => Inquiry::latest()->take(5)->get(),
            'latestInquiryUser' => User::find(Inquiry::get()->last()->petsitter_id)
        ]);
    }
}
