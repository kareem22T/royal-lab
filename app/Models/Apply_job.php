<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apply_job extends Model
{
    use HasFactory;
    protected $fillable = [
        "file_path",
        "name",
        "phone",
        "notes"
    ];

}
