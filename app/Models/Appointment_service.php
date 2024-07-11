<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment_service extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "name_ar",
    ];

    public $timestamps =false;
}
