<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'hinhanh_id','hinhanh_ten','hinhanh_anh','ma_id'
    ];
    protected $primaryKey = 'hinhanh_id';
    protected $table = 'hinhanh';
}
