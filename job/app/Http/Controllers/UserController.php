<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\User;


class UserController extends Controller
{
    //show Register/Create Form
    public function create()
    {
        return view('users.register');
    }

    //Create New User
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:6'
        ]);

        //Hash Password
        $formFields['password'] = bcrypt($formFields['password']);

        //Create user
        $user = User::create($formFields);

        //login
        auth()->login($user);

        return redirect('/')->with('message', 'User created and logged in');
    }

    //logout user
    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'You have been logged out successfully');
    }

    //Show Login Form
    public function login()
    {
        return view('users.login');
    }

    //Authenticate User
    public function authenticate(Request $request)
    {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        if (
            auth()->attempt([
                'email' => $formFields['email'],
                'password' => $formFields['password']
            ])
        ) {
            $request->session()->regenerate();

            return redirect('/')->with('message', 'You are now logged in!');
        }
        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }
}
