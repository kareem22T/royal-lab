<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;
    protected $fillable = [
        "date",
        "address",
        "service",
        "phone",
        "user_id",
        "status",
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
