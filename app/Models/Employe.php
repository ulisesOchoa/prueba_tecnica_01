<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'identification',
        'address',
        'phone',
        'city_id',
        'is_boss'
    ];
}
