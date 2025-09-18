<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CreateNewUser extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([ 
            'name'                      => 'required|string',
            'email'                     => 'required|email',
            'password'                  => 'required',
            'password_confirmation'     => 'required',
        ]);  

        $newUser = new User;
        $newUser->name = $request->input('name');
        $newUser->email = $request->input('email');
        $newUser->password = $request->input('password');
        $newUser->password_confirmation = $request->input('password_confirmation'); 
        $newUser->save();

        return redirect('/posts')->with('success', 'Registered Successfully'); 
    }
}