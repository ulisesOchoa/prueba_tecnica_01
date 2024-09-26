<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployePosition extends Model
{
    use HasFactory;

    protected $table = 'employees_positions';

    protected $fillable = [
        'user_id',
        'position_id',
    ];

    public function positions()
    {
        return $this->belongsTo(Position::class);
    }
}
