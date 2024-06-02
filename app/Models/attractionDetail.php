<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class attractionDetail extends Model
{
    use HasFactory;

    protected $table = 'attraction_details';

    protected $fillable = [
        'package_details_id',
        'attraction_name',
        'description',
        'visit_date',
        'entry_fee',
    ];

    public function package_details(){
        return $this->belongsTo(packageDetail::class);
    }
}
