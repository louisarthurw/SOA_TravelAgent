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
        'departure_date',
        'return_date',
        'number_of_people',
        'price',
        'quota'
    ];

    public function travel_agent(){
        return $this->belongsTo(travelAgent::class);
    }

    public function detail(){
        return $this->hasMany(packageDetail::class);
    }
}
