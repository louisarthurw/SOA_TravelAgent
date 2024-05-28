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
        'description',
        'origin_city',
        'destination_city',
        'departure_date',
        'return_date',
        'number_of_people'
    ];

    public function package(){
        return $this->belongsTo(package::class);
    }
}
