<?php

namespace App\Http\Controllers;

use App\Events\MotorCreated;
use App\Models\Motor;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MotorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Motor::where('user_id', Auth::user()->id)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $motor = new Motor();
        $motor->brand = $request->brand;
        $motor->color = $request->color;
        $motor->purchase_date = $request->purchase_date;
        $motor->plate_number = $request->plate_number;
        $motor->user_id = Auth::user()->id;
        $motor->save();
        MotorCreated::dispatch($motor);
        return $motor;
    }

    public function schedule(Motor $motor){
        $this->authorize('view', $motor);
        $schedules = DB::table('schedules')->selectRaw('spareparts.name as name, schedules.update + INTERVAL (spareparts.period*1) MONTH as period')
                               ->where('motor_id', $motor->id)->rightJoin('spareparts', 'schedules.sparepart_id', '=', 'spareparts.id')->get();
        return $schedules;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Motor  $motor
     * @return \Illuminate\Http\Response
     */
    public function show(Motor $motor)
    {
        $this->authorize('view', $motor);
        return $motor;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Motor  $motor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Motor $motor)
    {
        $this->authorize('update', $motor);
        $motor->brand = $request->brand;
        $motor->color = $request->color;
        $motor->purchase_date = $request->purchase_date;
        $motor->plate_number = $request->plate_number;
        $motor->save();
        return $motor;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Motor  $motor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Motor $motor)
    {
        $this->authorize('delete', $motor);
        $motor->delete();
        return $motor;
    }
}
