<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = ['client_id','date','time','status'];

    public function clients()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public static function appointmentToday()
    {
        $appoint = Appointment::where('date', date('Y-m-d', strtotime(now())))->count();
        return ['appointments'=>$appoint];
    }

    public static function onGoing()
    {
        $ongoing = Appointment::where('status', 'ongoing')
                                ->where('date', date('Y-m-d', strtotime(now())))
                                ->count();
        return ['ongoing'=>$ongoing];
    }

    public static function finished()
    {
        $finished = Appointment::where('status', 'finished')
                                ->where('date', date('Y-m-d', strtotime(now())))
                                ->count();
        return ['finished'=>$finished];
    }

    public static function weeksAppointment()
    {
        $fromdate = date('Y-m-d',strtotime('-7 days'));
        $todate = date('Y-m-d', strtotime(now()));
        
        $wapp = DB::select("SELECT COUNT(DISTINCT(client_id)) as num, date 
                            FROM `appointments`
                            WHERE date BETWEEN '".$fromdate."' AND '".$todate."' 
                            GROUP BY date");
        
        return $wapp;
    }
}
