<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class packageDetail extends Model
{
    use HasFactory;

    protected $table = 'package_details';

    protected $fillable = [
        'package_id',
        'day',
        'description',
        'origin_city',
        'destination_city',
    ];

    public function package(){
        return $this->belongsTo(package::class);
    }

    public function hotelDetails(){
        return $this->hasMany(hotelDetail::class);
    }

    public function flightDetails(){
        return $this->hasMany(flightDetail::class);
    }

    public function attractionDetails(){
        return $this->hasMany(attractionDetail::class);
    }
}
