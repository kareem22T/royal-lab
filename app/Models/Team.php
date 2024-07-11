<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "name_ar",
        "position",
        "position_ar",
        "photo_path",
    ];
}
