<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'tn_id','nv_id_tntu','nv_id_tnden','tn_tinnhan','tn_daxem','tn_thoigian'
    ];
    protected $primaryKey = 'tn_id';
    protected $table = 'tinnhan';
}
