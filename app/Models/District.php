<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    /** @use HasFactory<\Database\Factories\DistrictFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'city_id',
    ];

    public function city(){
        return $this->belongsTo(City::class);
    }
}
