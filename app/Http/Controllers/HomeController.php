<?php

namespace App\Http\Controllers;

use App\Models\Apero;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $aperos = Apero::all();

        return view('home', compact('aperos'));
    }
}
