<?php
 
namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Http\Controllers\RouteServiceProvider;

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
        return view('users.create'); // -> resources/views/stocks/create.blade.php
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
                'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'role' => 'required',
                'status' => 'required',
                // 'value'=>'required|max:10|regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/'
            ],
            [   
                'name.required' => 'Please Provide Your Email Address For Better Communication, Thank You.',
                'email.unique' => 'Sorry, this email address is already used by another user. Please try with different one.',
                'email.email' => 'Please try with correct email address'
                // 'role.required' => 'Password Is Required For Your Information Safety, Thank You.',
                // 'status.required'      => 'Password Length Should Be More Than 8 Character Or Digit Or Mix, Thank You.',
            ]
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            // 'email_verified_at' => date('Y-m-d H:i:s'),
            'email_verified_at' => '2022-11-30 09:25:34',
            'role' => $request->role,
            'status' => $request->status,
        ]);

        // event(new Registered($user));

        // Auth::login($user);

        // return redirect(RouteServiceProvider::HOME);

        return redirect('/users')->with('success', 'User saved.');   // -> resources/views/stocks/index.blade.php

    }
 
    /**
     * Display the specified resource. We don't need this one for this tutorial.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('users.show', ['user' => User::find($id)]);
    }
 
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit', compact('user'));  // -> resources/views/stocks/edit.blade.php
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
            'email' => 'required|email|unique:users',
            'role' => 'required',
            'status' => 'required',
            // 'value'=>'required|max:10|regex:/^-?[0-9]+(?:\.[0-9]{1,2})?$/'
        ],
        [   
            'name.required' => 'Please Provide Your Email Address For Better Communication, Thank You.',
            'email.unique' => 'Sorry, this email address is already used by another user. Please try with different one.',
            'email.email' => 'Please try with correct email address'
            // 'role.required' => 'Password Is Required For Your Information Safety, Thank You.',
            // 'status.required'      => 'Password Length Should Be More Than 8 Character Or Digit Or Mix, Thank You.',
        ]
        ); 

        $user = User::find($id);

        $user->name =  $request->get('name');
        $user->email = $request->get('email');
        $user->role = $request->get('role');
        $user->status = $request->get('status');
        $user->save();
 
        return redirect()->route('users.show', ['user' => User::find($id)])->with('success', __('User updated.'));
        // return view('users.show', ['user' => User::find($id)]);
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
 
        return redirect('/dashboard')->with('success', 'User removed.');
    } 
}