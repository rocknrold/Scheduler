<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Client extends Model
{
    use HasFactory;

    protected $fillable = ['name','age','gender','address'];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function feedback()
    {
        return $this->hasMany(Feedback::class, 'client_id', 'id');
    }

    public static function getGenders()
    {
        $male = Client::where('gender', 'male')->count();  
        $female = Client::where('gender', 'female')->count();  
        
        return ['male'=> $male, 'female'=> $female];
    }

    public static function newClients()
    {   
        $client = Client::where('created_at', '>=', Carbon::today())->count();
        return ['client'=>$client];
    }
}
