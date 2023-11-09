<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    protected function getLogin()
    {
        $showLoginBox = true;
        return view('login', ['showLoginBox' => $showLoginBox]);
    }
}
