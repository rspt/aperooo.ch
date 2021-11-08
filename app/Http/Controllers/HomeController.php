<?php

namespace App\Http\Controllers;

use App\Models\Apero;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $aperos = Apero::all();

            return view('home', compact('aperos'));
        }

        return view('home-guest');
    }
}
