<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $table = 'ads';

    use HasFactory;
    protected $fillable = ['image'];

}
