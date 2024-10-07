<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TouristProgram extends Model {
    use HasFactory;

    protected $fillable = [
        'type',
        'name',
        'description'
    ];
    public function Trip(){
        return $this->hasMany(TouristTrip::class,'tourist_program_id','id');
    }

}
