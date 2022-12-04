<?php

namespace App\Http\Controllers;

use App\Events\MotorCreated;
use App\Http\Requests\MotorRequest;
use App\Http\Resources\MotorResource;
use App\Models\Motor;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class MotorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return MotorResource::collection(Motor::where('user_id', Auth::user()->id)->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MotorRequest $request)
    {
        $motor = new Motor();
        $motor->year = $request->year;
        $motor->series = $request->series;
        $motor->type = $request->type;
        $motor->purchase_date = $request->purchase_date;
        $motor->plate_number = $request->plate_number;
        $motor->user_id = Auth::user()->id;
        $motor->save();
        return new MotorResource($motor);
    }

    // public function schedule(Motor $motor){
    //     $this->authorize('view', $motor);
    //     $schedules = Schedule::selectRaw('schedules.id as id, spareparts.name as name, schedules.update + INTERVAL (spareparts.period*1) MONTH as period')
    //                            ->where('motor_id', $motor->id)->rightJoin('spareparts', 'schedules.sparepart_id', '=', 'spareparts.id')->get();
    //     return $schedules;
    // }

    // public function updateSchedule(Request $request, Schedule $schedule){
    //     Gate::authorize('update-schedule', $schedule);
    //     $validated = $request->validate([
    //         'update' => ['required', 'date']
    //     ]);
    //     $schedule->update = $request->update;
    //     $schedule->save();
    // }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Motor  $motor
     * @return \Illuminate\Http\Response
     */
    public function show(Motor $motor)
    {
        $this->authorize('view', $motor);
        return new MotorResource($motor);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Motor  $motor
     * @return \Illuminate\Http\Response
     */
    public function update(MotorRequest $request, Motor $motor)
    {
        $this->authorize('update', $motor);
        $motor->year = $request->year;
        $motor->series = $request->series;
        $motor->type = $request->type;
        $motor->purchase_date = $request->purchase_date;
        $motor->plate_number = $request->plate_number;
        $motor->save();
        return new MotorResource($motor);
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
        return new MotorResource($motor);
    }
}
