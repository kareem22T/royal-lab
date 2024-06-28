<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;

    protected $fillable = [
        "file_path",
        "user_id",
        "notes"
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

}
