<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detailsroles extends Model
{
     public $timestamps = false;
    protected $fillable = [
        'ctquyen_id','nv_id','quyen_id'
    ];
    protected $primaryKey = 'ctquyen_id';
    protected $table = 'ctquyen';

    
}
