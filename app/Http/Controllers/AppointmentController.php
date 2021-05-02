<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Client;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    public function weeksAppointment(Request $request)
    {
        $wapp = Appointment::weeksAppointment();
        return response()->json($wapp);
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
        // dd($request->all());
        $validated = $request->validate([
            'name' => 'required',
            'age' => 'required|numeric',
            'gender' => 'required',
            'address' => 'required',
            'date' => 'required',
            'time' => 'required',
        ]);

        if($validated){
            
            $client = Client::create([
                'name' => $request->name,
                'age'  => $request->age,
                'gender' => $request->gender,
                'address' => $request->address,
            ]);
            
            $napp = Appointment::create([
                'client_id' => $client->id,
                'date' => $request->date,
                'time' => $request->time,
                'status'=> 'ongoing',
            ]);
            
            return response()->json([$client,$napp]);
            
        }else {
            return response()->json($validated->errors());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {
        $eapp = Appointment::find($appointment->id);
        return $eapp;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointment $appointment)
    {
        // dd($request->all());

        $validated = $request->validate([
            'status' => 'required',
            'date' => 'required',
            'time' => 'required',
        ]);

        if($validated)
        {
            $uapp = Appointment::where('id',$request->id)->update([
                                        'status'=>$request->status,
                                        'date'=>$request->date,
                                        'time'=>$request->time,
                                    ]);

            return response()->json(Appointment::with(['clients'])->where('id',$request->id)->first());
        } else 
        {
            return response()->json($validated->errors());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        // dd($appointment);
        $dapp = Appointment::findOrFail($appointment->id);
        $dapp->delete();
        
        return response()->json($dapp);
    }
}
