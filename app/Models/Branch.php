<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'address',
        'phone',
        'city_id',
        'region_id',
    ];

    protected $table = 'branches';

    public $timestamps = false;

}
