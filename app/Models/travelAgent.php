<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class travelAgent extends Model
{
    use HasFactory;
    protected $table = 'travel_agent';

    protected $fillable = [
        'name',
        'contact_info'
    ];

    // public function package(){
    //     return $this->hasMany(package::class);
    // }
}
