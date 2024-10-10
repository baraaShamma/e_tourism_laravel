<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TouristProgram extends Model {
    use HasFactory;

    protected $fillable = [
        'type',
        'name',
        'description',
        'image'
    ];
    public function Trip(){
        return $this->hasMany(TouristTrip::class,'tourist_program_id','id');
    }
    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/tourist_programs/' . $this->image) : null;
    }


}
