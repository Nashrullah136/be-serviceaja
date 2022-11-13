<?php

namespace App\Http\Controllers;

use App\Http\Requests\SparepartRequest;
use App\Http\Resources\SparepartResource;
use App\Models\Sparepart;
use Illuminate\Http\Request;

class SparepartController extends Controller
{

    // public function
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SparepartResource::collection(Sparepart::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SparepartRequest $request)
    {
        $sparepart = new Sparepart();
        $sparepart->name = $request->name;
        $sparepart->period = $request->period;
        $sparepart->save();
        return new SparepartResource($sparepart);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sparepart  $sparepart
     * @return \Illuminate\Http\Response
     */
    public function show(Sparepart $sparepart)
    {
        return new SparepartResource($sparepart);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sparepart  $sparepart
     * @return \Illuminate\Http\Response
     */
    public function update(SparepartRequest $request, Sparepart $sparepart)
    {
        $sparepart->name = $request->name;
        $sparepart->period = $request->period;
        $sparepart->save();
        return new SparepartResource($sparepart);
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
        return new SparepartResource($sparepart);
    }
}
