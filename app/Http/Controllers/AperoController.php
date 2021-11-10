<?php

namespace App\Http\Controllers;

use App\Models\Apero;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AperoController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Apero::class, 'apero');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userAperos = Auth::user()->aperos->sortBy('start')->where('postulable', true);

        return view('aperos.index', compact('userAperos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('aperos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $apero = Auth::user()->aperos()->create($request->all());

        return redirect()->route('aperos.show', $apero);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Apero  $apero
     * @return \Illuminate\Http\Response
     */
    public function show(Apero $apero)
    {
        return view('aperos.show', compact('apero'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Apero  $apero
     * @return \Illuminate\Http\Response
     */
    public function edit(Apero $apero)
    {
        return view('aperos.edit', compact('apero'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Apero  $apero
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Apero $apero)
    {
        $apero->update($request->all());

        return redirect()->route('aperos.show', $apero);
    }

    /**
     * Close the specified Apero.
     *
     * @param  \App\Models\Apero  $apero
     * @return \Illuminate\Http\Response
     */
    public function close(Apero $apero)
    {
        $this->authorize('close', $apero);

        $apero->closePostulation();

        return redirect()->route('aperos.show', $apero);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Apero  $apero
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apero $apero)
    {
        $apero->delete();

        return redirect()->route('aperos.index');
    }
}
