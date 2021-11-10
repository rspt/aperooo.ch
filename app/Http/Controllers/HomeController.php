<?php

namespace App\Http\Controllers;

use App\Models\Apero;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $aperos = Apero::where('start', '>=', Carbon::now())
                        ->where('postulable', true)
                        ->orderBy('start')
                        ->get();

            return view('home', compact('aperos'));
        }

        return view('home-guest');
    }
}
