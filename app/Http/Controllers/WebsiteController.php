<?php
 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\City;
use App\Models\User;
use App\Models\Opinion;
use App\Models\ProfileImage;
use App\Models\Inquiry;
use Illuminate\Support\Facades\Auth;
use App\Mail\NewInquiryMail;
use App\Mail\NewOpinionMail;
use Illuminate\Support\Facades\Mail;

class WebsiteController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function search() 
    {
        $cities = City::all();
        $services = Service::all();

        return view('website.search', [
            'cities' => $cities,
            'services' => $services
        ]); // -> resources/views/website/search.blade.php
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search_results(Request $request) 
    {
        $service_id = $request->get('service_id');
        $city_id = $request->get('city_id');

        $users = User::where('city_id', $city_id)->where('role', 'Petsitter')->get();

        $users = User::with('petsitter_services.service', 'profile_image')
            ->where('city_id', $city_id)
            ->where('role', 'Petsitter')
            ->where('status', 'Published')
            ->whereHas('petsitter_services', function ($query) use ($service_id) {
                $query->where('service_id', $service_id);
            })
        ->get();

        $users_count = count($users) ?? 0;

        $city = City::find($city_id);
        $other_cities = City::where('id', '!=', $city_id)->get();
                
        $service = Service::find($service_id);
        $other_services = Service::where('id', '!=', $service_id)->get();

        return view('website.search_results', [
            'users' => $users,
            'city' => $city,
            'other_cities' => $other_cities,
            'service' => $service,
            'other_services' => $other_services,
            'users_count' => $users_count
        ]); // -> resources/views/website/search_results.blade.php
    }

    /**
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show_profile($id) 
    {
        $user = User::with(['petsitter_services.service', 'opinions' => function($query) {
            $query->where('status', 'Published');
        }])->find($id);

        $city = City::find($user->city_id);

        $profile_image = ProfileImage::where('user_id', $user->id)->first();

        if($profile_image) {
            $profile_image_path = $profile_image->path;
        } else {
            $profile_image_path = null;
        }

        return view('website.show_profile', [
            'user' => $user,
            'city' => $city,
            'profile_image_url' => $profile_image_path
        ]);
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create_inquiry(Request $request) 
    {
        $request->validate(
            [
                'service_id' => 'required',
                'city_id' => 'required',
                'weight' => 'required',
                'age' => 'required',
                'message' => 'required',
                // 'petsitter_id' => 'required',
                // 'customer_id' => 'required',
            ],
            [   
                'required' => 'This field cannot be empty',
            ]
        ); 

        $inquiry = new Inquiry;
        $inquiry->service_id = $request->get('service_id');
        $inquiry->city_id = $request->get('city_id');
        $inquiry->weight = $request->get('weight');
        $inquiry->age = $request->get('age');
        $inquiry->message = $request->get('message');
        $inquiry->petsitter_id = $request->get('id');
        $inquiry->customer_id = Auth::id();
        $inquiry->save();

        $petsitter = User::find($request->get('id'));
        $customer = User::find(Auth::id());

        $url = url("/your_inquiry_petsitter/$inquiry->id");

        Mail::to($petsitter->email)->send(new NewInquiryMail($customer->name, $customer->email, $url));

        // Przekieruj z powrotem do strony /show_profile/{id} i wyświetl komunikat
        return redirect()->route('website.show_profile', ['id' => $request->get('id')])->with('success', 'Zapytanie zostało wysłane');
    }

    /**
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function add_opinion($id) 
    {
        $user = User::find($id);
        $customer = User::find(Auth::id());

        return view('website.add_opinion', [
            'user' => $user,
            'customer' => $customer
        ]);
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create_opinion(Request $request) 
    {
        // $request->validate(
        //     [
        //         'text' => 'required',
        //         'score' => 'required',
        //         'petsitter_id' => 'required',
        //         'customer_id' => 'required'
        //     ],
        //     [   
        //         'required' => 'This field cannot be empty',

        //     ]
        // ); 

        $opinion = new Opinion;
        $opinion->text = $request->get('text');
        $opinion->score = $request->get('score');
        $opinion->petsitter_id = $request->get('id');
        $opinion->customer_id = Auth::id();
        $opinion->status = 'Pending';
        $opinion->save();

        $petsitter = User::find($opinion->petsitter_id);
        $customer = User::find($opinion->customer_id);
        $url = "http://localhost";

        Mail::to($petsitter->email)->send(new NewOpinionMail($customer->name, $customer->email, $url));

        return redirect()->route('website.add_opinion', ['id' => $request->get('id')])->with('success', 'Zapytanie zostało wysłane');

        dd($opinion);
    }
}