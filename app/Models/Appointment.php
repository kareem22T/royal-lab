<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "age",
        "phone",
        "sub_total",
        "branch_id",
        "service_id",
        "user_id",
        "status",
        "service",
        "date",
    ];

    protected $table = "appointmnts";

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function service()
    {
        return $this->belongsTo('App\Models\Product', 'service_id');
    }

    public function branch()
    {
        return $this->belongsTo('App\Models\Branch', 'branch_id');
    }

}
