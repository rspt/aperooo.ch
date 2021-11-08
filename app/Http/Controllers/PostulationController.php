<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Apero;
use App\Models\Postulation;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostulationController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Postulation::class, 'postulation', [
            'except' => ['store'],
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aperos = Auth::user()->postulations; 
        $aperos = [
            'open' => $aperos->where('pivot.status', 'open'),
            'cancelled' => $aperos->where('pivot.status', 'cancelled'),
            'accepted' => $aperos->where('pivot.status', 'accepted'),
            'declined' => $aperos->where('pivot.status', 'declined'),
        ];

        return view('postulations.index', compact('aperos'));
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
    public function store(Request $request, Apero $apero)
    {
        $this->authorize('create', [Postulation::class, $apero]);

        try {
            Postulation::create([
                'user_id' => Auth::user()->id,
                'apero_id' => $apero->id,
                'motivation' => $request->input('motivation'),
            ]);
        } catch (QueryException $e) {
            $sqlErrorCode = $e->errorInfo[1];

            switch ($sqlErrorCode) {
                case '1062':
                    back()->with('alert', [
                        'message' => 'postulations.alreadyPostulate',
                        'type' => 'error',
                    ]);
                    break;
            }
        }

        return redirect()->route('aperos.show', $apero->id);
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
    public function update(Request $request, Apero $apero, Postulation $postulation)
    {
        $postulation->update([
            'motivation' => $request->motivation,
        ]);
        return redirect()->route('aperos.show', $apero);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Postulation  $postulation
     * @return \Illuminate\Http\Response
     */
    public function cancel(Request $request, Apero $apero, Postulation $postulation)
    {
        $this->authorize('cancel', $postulation);

        $postulation->status = 'cancelled';
        $postulation->save();

        return redirect()->route('aperos.show', $postulation->apero_id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Postulation  $postulation
     * @return \Illuminate\Http\Response
     */
    public function accept(Request $request, Apero $apero, Postulation $postulation)
    {
        $this->authorize('accept', [$postulation, $apero]);

        $postulation->status = 'accepted';
        $postulation->save();

        return redirect()->route('aperos.show', $postulation->apero_id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Postulation  $postulation
     * @return \Illuminate\Http\Response
     */
    public function decline(Request $request, Apero $apero, Postulation $postulation)
    {
        $this->authorize('decline', [$postulation, $apero]);

        $postulation->status = 'declined';
        $postulation->save();

        return redirect()->route('aperos.show', $postulation->apero_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Postulation  $postulation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Postulation $postulation)
    {
        //
    }
}