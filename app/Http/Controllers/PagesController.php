<?php

namespace App\Http\Controllers;


class PagesController extends Controller
{
    public function getHome()
    {
        return view('home');
        
    }

    public function getProfile()
    {
        
        return view('users/profile');
        
    }
}
