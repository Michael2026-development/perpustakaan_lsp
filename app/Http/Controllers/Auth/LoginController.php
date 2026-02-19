<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function show(){
       return view('auth.login');
    }

    public function login(LoginRequest $request){
        if (! Auth::attempt($request->validated())){
            return back()->withErrors([
                'username' => 'username or password incorrect'
            ]);
        }

        $user = Auth::user();
        
        // Redirect based on user role
        if ($user->role === UserRole::SISWA) {
            return redirect('/siswa/dashboard');
        }
        
        return redirect('/dashboard');
    }
}

