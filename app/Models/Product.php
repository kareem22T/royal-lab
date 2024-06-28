<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "name_ar",
        "main_image",
        "description",
        "description_ar",
        "price",
        "type",
    ];

    public function gallery()
    {
        return $this->hasMany('App\Models\Gallery', 'product_id');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Ordered_Product', 'product_id');
    }


}
