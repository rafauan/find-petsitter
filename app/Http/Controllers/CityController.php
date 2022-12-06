<?php
 
namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\City;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Http\Controllers\RouteServiceProvider;

class CityController extends Controller
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

            $cities = City::query()
                ->where('name', 'LIKE', "%{$search}%")
                ->orWhere('province', 'LIKE', "%{$search}%")
                ->orWhere('country', 'LIKE', "%{$search}%")
                ->orWhere('zip_code', 'LIKE', "%{$search}%")
                ->paginate(10);
        } else {
            $cities = City::paginate(10);
        }
        
        return view('cities.index', compact('cities')); // -> resources/views/cities/index.blade.php 
    }
 
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cities.create'); // -> resources/views/cities/create.blade.php
    }
 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            [
                'name' => ['required', 'string', 'max:255'],
                'country' => ['required', 'string', 'max:255'],
                'province' => ['required', 'string', 'max:255'],
                'zip_code' => ['required', 'string', 'postal_code:PL'],
            ],
            [   
                'name.required' => 'This field \'name\' is provided.',
                'country.required' => 'This field \'country\' is provided.',
                'province.required' => 'This field \'province\' is provided.',
                'zip_code.postal_code:PL' => 'Please try with correct postal code'
                // 'role.required' => 'Password Is Required For Your Information Safety, Thank You.',
                // 'status.required'      => 'Password Length Should Be More Than 8 Character Or Digit Or Mix, Thank You.',
            ]
        ]);

        $city = City::create([
            'name' => $request->name,
            'country' => $request->country,
            'province' => $request->province,
            'zip_code' => $request->zip_code
        ]);

        // event(new Registered($user));

        // Auth::login($user);

        // return redirect(RouteServiceProvider::HOME);

        return redirect('/cities')->with('success', 'City saved.');   // -> resources/views/cities/index.blade.php

    }
 
    /**
     * Display the specified resource. We don't need this one for this tutorial.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('cities.show', ['city' => City::find($id)]);
    }
 
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $city = City::find($id);
        return view('cities.edit', compact('city'));  // -> resources/views/cities/edit.blade.php
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
        // Validation for required fields (and using some regex to validate our numeric value)
        $request->validate(
        [
            'name' => 'required',
            'country' => 'required',
            // 'email' => 'required|email|unique:users',
            'province' => 'required',
            'zip_code' => 'required',
        ],
        [   
            'name.required' => 'Please Provide Your Email Address For Better Communication, Thank You.',
            'country.required' => 'Please Provide Your Email Address For Better Communication, Thank You.',
            'province.required' => 'Sorry, this email address is already used by another user. Please try with different one.',
            'zip_code.required' => 'Please try with correct email address'
            // 'role.required' => 'Password Is Required For Your Information Safety, Thank You.',
            // 'status.required'      => 'Password Length Should Be More Than 8 Character Or Digit Or Mix, Thank You.',
        ]
        ); 

        $city = City::find($id);

        $city->name =  $request->get('name');
        $city->country = $request->get('country');
        $city->province = $request->get('province');
        $city->zip_code = $request->get('zip_code');
        $city->save();
 
        return redirect()->route('cities.show', ['city' => City::find($id)])->with('success', __('City updated.'));
    }
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $city = City::find($id);
        $city->delete(); 
 
        return redirect('/dashboard')->with('success', 'City removed.');
    } 
}