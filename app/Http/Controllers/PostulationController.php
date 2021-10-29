<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Apero;
use App\Models\Postulation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PostulationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aperoUser = Auth::user()->id;
        $aperoPostulate = Postulation::all()->where('user_id', $aperoUser);
        $aperoOpen = [];
        foreach ($aperoPostulate as $apero) {
            if($apero->status == 'open') {
            array_push($aperoOpen, Apero::find($apero->apero_id));
            }
        }

        $aperoCancelled = [];
        foreach ($aperoPostulate as $apero) {
            if($apero->status == 'cancelled'){
            array_push($aperoCancelled, Apero::find($apero->apero_id));
            }
        }
      
        return view('postulations.index', compact('aperoOpen', 'aperoCancelled'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Postulation::create([
            'user_id' => Auth::user()->id,
            'apero_id' => $request->apero_id,
        ]);

        return redirect()->route('postulations.index', 'user_id');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Postulation  $postulation
     * @return \Illuminate\Http\Response
     */
    public function show(Postulation $postulation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Postulation  $postulation
     * @return \Illuminate\Http\Response
     */
    public function edit(Postulation $postulation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Postulation  $postulation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Postulation $postulation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Postulation  $postulation
     * @return \Illuminate\Http\Response
     */
    public function cancel()
    {
        // $postulation = Postulation::find(1)
        //                 ->where('user_id', $user->id)
        //                 ->where('apero_id', $apero->id)
        //                 ->getStatus();
        // dd($postulation);

        $apero = Apero::find(1);


        return redirect()->route('postulations.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Postulation  $postulation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Postulation $postulation)
    {
        
    }
}
