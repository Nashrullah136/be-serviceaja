<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceRequest;
use App\Http\Resources\ServiceResource;
use App\Models\Motor;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $motor = $request->query('motor_id', 'all');
        $result = Service::select('*');
        if($motor !== 'all'){
            $result = $result->where('motor_id', $motor);
        }
        $result = $result->whereIn('motor_id',
            Motor::select('id')->where('user_id', Auth::user()->id)
        )->get();
        return new ServiceResource($result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceRequest $request)
    {
        $service = new Service();
        $service->location = $request->location;
        $service->service_date = date("Y-m-d", strtotime($request->service_date));
        $service->fixes = $request->fixes;
        $service->motor_id = $request->motor_id;
        $service->save();
        return new ServiceResource($service);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
