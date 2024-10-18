<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TouristTripImage extends Model
{    protected $table = 'tourist_trip_images'; 

    protected $fillable = ['tourist_trip_id', 'image'];

    // الربط مع جدول الرحلات السياحية
    public function touristTrip()
    {
        return $this->belongsTo(TouristTrip::class);
    }
}
