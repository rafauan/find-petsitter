<?php
 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Service;
use App\Models\City;
use App\Models\PetsitterServices;
use App\Models\ProfileImage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Mail\AdminApprovedChangesMail;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->filled('search')) {
            $search = $request->input('search');

            $users = User::query()
                ->where('name', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%")
                ->paginate(10);
        } else {
            $users = User::paginate(10);
        }
        
        return view('users.index', compact('users')); // -> resources/views/users/index.blade.php 
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create', [
            'services' => Service::all(),
            'cities' => City::all(),
            'statuses' => ['Published', 'Blocked', 'Draft'],
            'roles' => ['Customer', 'Petsitter', 'Admin']
        ]); // -> resources/views/users/create.blade.php
    }
 
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation for required fields (and using some regex to validate our numeric value)
        $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'role' => 'required',
                'status' => 'required',
            ],
            [   
                'required' => 'This field cannot be empty',
                'email.unique' => 'Sorry, this email address is already used by another user. Please try with different one',
                'email.email' => 'Please try with correct email address',
                'password.min' => 'The minimum number of characters is 8'
            ]
        ); 

        $user = new User;
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));
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

        if($user->role == 'Petsitter' && $services) {
            foreach($services as $service) {
                $inquiry_petsitter = new PetsitterServices;
                $inquiry_petsitter->petsitter_id = $user->id;
                $inquiry_petsitter->service_id = $service;
                $inquiry_petsitter->save();
            }
        }

        return redirect('/users')->with('success', 'New user created');   // -> resources/views/users/index.blade.php
    }    
 
    /**
     * Display the specified resource. We don't need this one for this tutorial.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $petsitter_services = PetsitterServices::where('petsitter_id', $id)->get();

        $service_ids = $petsitter_services->pluck('service_id')->toArray();

        $services = Service::whereIn('id', $service_ids)->get();

        $user = User::find($id);

        $city = City::find($user->city_id);

        $profile_image = ProfileImage::where('user_id', $user->id)->first();

        if($profile_image) {
            $profile_image_path = $profile_image->path;
        } else {
            $profile_image_path = null;
        }

        return view('users.show', [
            'user' => $user,
            'city' => $city,
            'petsitter_services' => $petsitter_services,
            'services' => $services,
            'profile_image_url' => $profile_image_path
        ]);
    }
 
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // User
        $user = User::find($id) ?? [];
        
        // Services
        $petsitter_services = PetsitterServices::where('petsitter_id', $id)->get() ?? [];
        $service_ids = $petsitter_services->pluck('service_id')->toArray() ?? [];
        $user_services = Service::whereIn('id', $service_ids)->get() ?? [];
        $services = Service::all() ?? [];
        $services = $services->diff($user_services) ?? [];

        // Cities
        $cities = City::all() ?? [];
        $city = City::find($user->city_id) ?? [];
        $other_cities = City::where('id', '!=', $user->city_id)->get() ?? [];

        $profile_image = ProfileImage::where('user_id', $id)->first() ?? [];

        if($profile_image) {
            $profile_image_path = $profile_image->path;
        } else {
            $profile_image_path = null;
        }

        return view('users.edit', [
            'services' => $services,
            'user' => $user,
            'user_services' => $user_services,
            'cities' => $cities,
            'profile_image_url' => $profile_image_path,
            'city' => $city,
            'other_cities' => $other_cities
        ]); // -> resources/views/stocks/edit.blade.php
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

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

        if($request->get('status') == 'Published') {
            Mail::to($user->email)->send(new AdminApprovedChangesMail(url('/dashboard')));
        }
 
        return redirect()->route('users.show', ['user' => User::find($id)])->with('success', __('User updated'));
    }
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete(); // Easy right?
 
        return redirect('/dashboard')->with('success', 'User removed');
    } 
}