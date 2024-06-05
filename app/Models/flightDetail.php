<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class flightDetail extends Model
{
    use HasFactory;

    protected $table = 'flight_details';

    protected $fillable = [
        'airline_name',
        'flight_number',
        'departure_time',
        'arrival_time',
        'flight_class'
    ];

    public function package_details(){
        return $this->belongsTo(packageDetail::class);
    }
}
