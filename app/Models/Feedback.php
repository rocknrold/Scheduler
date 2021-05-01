<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;
    protected $fillable = ['client_id','note'];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public static function feedbacks()
    {
        $feed = Feedback::with('client')->paginate(2);
        return ['feeds' => $feed];
    }
}
