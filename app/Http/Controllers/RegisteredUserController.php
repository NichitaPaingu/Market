<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;


class RegisteredUserController extends Controller
{
    
    public function create(){
        return view('auth.register');
    }
    public function store(Request $request){
        //validate
        $attributes = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email', 'max:255'],
            'password' => ['required', 'confirmed', Password::min(8)],      //->letters()->mixedCase()->numbers()->symbols()
        ]);

        unset($attributes['password_confirmation']);
        //create the user
        $user = User::create($attributes);
        //log in
        $remember = $request->has('user_remember');
        Auth::login($user,$remember);
        //redirect 
        return redirect('/dashboard')->with('success', 'Registration successful');
    }
}
