<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create(){
        return view('auth.login');
    }
    public function store(Request $request){
        //validate
        $validatedAttributes = request()->validate([
            'email'=>['required','email'],
            'password' =>['required']
        ]);
        $remember=$request->has('user_remember');
        //attempt to login the user
        if(!Auth::attempt($validatedAttributes,$remember)){
            throw ValidationException::withMessages([
                'password'=>'Sorry, those credentianals do not match.',
            ]);
        }

        //regenerate the session token
        request()->session()->regenerate();
        //redirect
        return redirect('/dashboard');
    }
    public function destroy(){
        Auth::logout();
        return redirect('/login');
    }
}
