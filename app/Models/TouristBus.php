<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TouristBus extends Model
{
    use HasFactory;

    protected $table = 'tourist_buses'; // تأكد من أن الجدول هنا هو الصحيح

    protected $fillable = [
        'bus_number', 'bus_type', 'seat_count', 'bus_status',
    ];
      // إضافة العلاقة مع جدول bus_driver
      public function busDriver()
      {
          return $this->hasOne(BusDriver::class, 'bus_id');
      }
}
