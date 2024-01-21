<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //login page
    public function loginPage(){
        return view('login');
    }

    // register page
    public function registerPage(){
        return view('register');
    }

    public function dashboard(){
        if(Auth::user()->role == 'admin'){
            return redirect()->route('category#home');
        }
        return redirect()->route('user#home');
    }




    }
