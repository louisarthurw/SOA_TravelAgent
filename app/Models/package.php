<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class package extends Model
{
    use HasFactory;
 
    protected $table = 'package';

    protected $fillable = [
        'travel_agent_id',
        'flight_id',
        'hotel_id',
        'attraction_id',
        'price'
    ];

    public function travel_agent(){
        return $this->belongsTo(travelAgent::class);
    }

    public function detail(){
        return $this->hasOne(packageDetail::class);
    }
}
