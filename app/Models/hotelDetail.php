<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hotelDetail extends Model
{
    use HasFactory;

    protected $table = 'hotel_details';

    protected $fillable = [
        'hotel_name',
        'address',
        'room_type',
        'room_number',
    ];

    public function package_details(){
        return $this->belongsTo(packageDetail::class);
    }
}
