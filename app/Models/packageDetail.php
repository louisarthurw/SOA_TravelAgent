<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class packageDetail extends Model
{
    use HasFactory;

    protected $table = 'package_details';

    public function package(){
        return $this->belongsTo(package::class);
    }
}
