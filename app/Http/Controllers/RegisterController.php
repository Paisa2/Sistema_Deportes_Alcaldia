<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function create(){
        return view('auth.register');

    }

    public function store(){

        $this->validate(request(), [
            'name' => 'required',
            'apellido' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
            'role' => 'required',
        ]);

        $user = User::create(request(['name','apellido','email','password', 'role']));

        auth()->login($user);
        return redirect()->to('/entrenador');
    }
}
