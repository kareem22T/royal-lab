<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "name_ar",
    ];

    public $timestamps = false;

    public function specializations()
    {
        return $this->hasMany('App\Models\Specialization', 'doctor_id');
    }


}
