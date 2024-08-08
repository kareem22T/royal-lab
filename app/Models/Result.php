<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        "service_name",
        "service_name_ar",
        "date",
        "status",
        "file",
        "user_id",
        "gender",
        "age",
        "contact_no",
        "patient_name",
        "bill_id",
        "lab_patient_id",
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

}
