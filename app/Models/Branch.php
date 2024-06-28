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
        'address_ar',
        'phone',
        'city_id',
        'region_id',
    ];

    protected $table = 'branches';

    public $timestamps = false;

    /**
     * Get the city associated with the Branch
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function city()
    {
        return $this->hasOne(City::class, 'id', 'city_id');
    }
    public function region()
    {
        return $this->hasOne(Region::class, 'id', 'region_id');
    }
}
