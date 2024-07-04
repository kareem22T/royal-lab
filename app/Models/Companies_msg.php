<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Companies_msg extends Model
{
    use HasFactory;

    protected $fillable = [
        'where',
        'name',
        'email',
        'subject',
        'notes'
    ];
}
