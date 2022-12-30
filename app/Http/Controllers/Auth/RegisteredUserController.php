<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Mail\AccountVerificationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use App\Models\City;
use App\Mail\NewUserMail;
class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $cities = City::all();
        // return view('auth.register');
        return view('auth.register', compact('cities'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'role' => ['required'],
                'city_id' => ['required']
            ],
            [   
                'email.unique' => 'Sorry, this email address is already used by another user. Please try with different one',
                'password.min' => 'The minimum number of characters is 8'
            ]
        );

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => 'Draft',
            'role' => $request->role,
            'city_id' => $request->city_id
        ]);

        event(new Registered($user));

        $admins = User::where('role', 'Admin')->get();

        foreach($admins as $admin) {
            Mail::to($admin->email)->send(new NewUserMail($user->name, $user->email, $user->id, $user->role));
        }

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }


    
}
