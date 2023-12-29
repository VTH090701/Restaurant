<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'khachhang_ten','khachhang_sdt','khachhang_email','khachhang_hinhanh','khachhang_diachi','khachhang_token','khachhang_matkhau','khachhang_diachi','khachhang_trangthai'
        // 'matp','maqh','xaid',
    ];
    protected $primaryKey = 'khachhang_id';
    protected $table = 'khachhang';
    // public function product(){
    //     return $this->hasMany('App\Models\Comment');
    // }
    // public function city()
    // {
    //     return $this->belongsTo(City::class,'matp');
    // }
    // public function province()
    // {
    //     return $this->belongsTo(Province::class,'maqh');
    // }
    // public function wards()
    // {
    //     return $this->belongsTo(Wards::class,'xaid');
    // }

}
