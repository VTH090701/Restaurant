<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'gg_id','gg_ten','gg_stg','gg_tinhnang','gg_soluong','gg_magiam','gg_ngaybd','gg_ngaykt'
    ];
    protected $primaryKey = 'gg_id';
    protected $table = 'giamgia';

}
