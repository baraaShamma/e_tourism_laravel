<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TripRegistration extends Model
{
    protected $fillable = ['tourist_trip_id', 'user_id'];

    public function touristTrip()
    {
        return $this->belongsTo(TouristTrip::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
