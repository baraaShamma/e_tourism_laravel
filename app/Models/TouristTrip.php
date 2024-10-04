<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TouristTrip extends Model
{
    protected $table = 'tourist_trips'; 

    protected $fillable = ['tourist_program_id', 'bus_id', 'guide_id', 'price', 'max_capacity', 'trip_date'];

    public function touristProgram()
    {
        return $this->belongsTo(TouristProgram::class,"tourist_program_id","id");
    }

    public function bus()
    {
        return $this->belongsTo(TouristBus::class);
    }

    public function guide()
    {
        return $this->belongsTo(User::class, 'guide_id');
    }

    public function registrations()
    {
        return $this->hasMany(TripRegistration::class);
    }
}

