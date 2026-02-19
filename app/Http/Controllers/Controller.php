<?php

namespace App\Http\Controllers;

abstract class Controller
{

    public function viewLogin(){
        return view('login');
    }

    public function viewRegister(){
        return view('register');
    }
}
