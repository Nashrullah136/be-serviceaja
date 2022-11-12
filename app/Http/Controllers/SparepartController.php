<?php

namespace App\Http\Controllers;

use App\Models\Sparepart;
use Illuminate\Http\Request;

class SparepartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Sparepart::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sparepart = new Sparepart();
        $sparepart->name = $request->name;
        $sparepart->period = $request->period;
        $sparepart->save();
        return $sparepart;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sparepart  $sparepart
     * @return \Illuminate\Http\Response
     */
    public function show(Sparepart $sparepart)
    {
        return $sparepart;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sparepart  $sparepart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sparepart $sparepart)
    {
        $sparepart->name = $request->name;
        $sparepart->period = $request->period;
        $sparepart->save();
        return $sparepart;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sparepart  $sparepart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sparepart $sparepart)
    {
        $sparepart->delete();
        return $sparepart;
    }
}
