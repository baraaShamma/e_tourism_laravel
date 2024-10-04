<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusDriver extends Model
{
    use HasFactory;
    protected $table = 'bus_driver';

    protected $fillable = [
        'bus_id',
        'user_id',
    ];

    // العلاقة مع الحافلة
    public function bus()
    {
        return $this->belongsTo(TouristBus::class, 'bus_id');
    }

    // العلاقة مع المستخدم
      // إضافة العلاقة مع جدول users (السائقين)
      public function driver()
      {
          return $this->belongsTo(User::class, 'user_id')->where('type_user', 'driver');
      }
}
