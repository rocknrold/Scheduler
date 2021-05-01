<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Client;
use Illuminate\Http\Request;
use Redirect;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $client = Client::where('name',$request->name)
                        ->where('age',$request->age)
                        ->where('gender',$request->gender)
                        ->where('address',$request->address)
                        ->first();
        if($client)
        {
            $feedback = Feedback::create(['client_id'=>$client->id,
                                        'note'=>$request->note]); 
        } else 
        {
            if($request->address != null)
            {
                $cclient = Client::create($request->all());
            }else
            {
                $cclient = Client::create(['name'=>$request->name,
                                           'age'=>$request->age,
                                           'gender'=>$request->gender,
                                           'address'=>"No information available"]);
            }

            $feedback = Feedback::create(['client_id'=>$cclient->id,'note'=>$request->note]);
            // dd($cclient,$feedback);
        }

        if($feedback)
        {
            return Redirect::to('/feedback')->with('status', 'Feedback submitted, Thank you! ');
        }

        return Redirect::to('/feedback')->with('status', 'Something went wrong!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function show(Feedback $feedback)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function edit(Feedback $feedback)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Feedback $feedback)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feedback $feedback)
    {
        //
    }
}
