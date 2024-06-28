<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medical_consultation extends Model
{
    use HasFactory;

    protected $fillable = [
        "doctor_id",
        "specialization_id",
        "user_id",
        "status",
        "date",
    ];

    protected $table = "medical_consultations";

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function doctor()
    {
        return $this->belongsTo('App\Models\Doctor', 'doctor_id');
    }

    public function specialization()
    {
        return $this->belongsTo('App\Models\Specialization', 'specialization_id');
    }

}
