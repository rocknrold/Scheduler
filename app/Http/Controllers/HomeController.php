<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Appointment;
use App\Models\Feedback;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $feeds = Feedback::feedbacks();
        $appointments = Appointment::with(['clients'])->orderBy('date','desc')->paginate(5, ['*'], 'page_app');
        // dd($appointments);
        return view('home')->with(['appointments'=>$appointments,'feeds'=>$feeds]);
    }

    public function chartHeaders(Request $request)
    {   
        $appoint = Appointment::appointmentToday();
        $onging = Appointment::ongoing();
        $finish = Appointment::finished();
        $client = Client::newClients();

        return response()->json([$appoint,$onging,$finish,$client]);
    }
}
