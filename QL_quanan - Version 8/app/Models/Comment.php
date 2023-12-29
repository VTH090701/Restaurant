<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'binhluan_id','ma_id','khachhang_id','binhluan_noidung','binhluan_thoigian'
    ];
    protected $primaryKey = 'binhluan_id';
    protected $table = 'binhluan';

    public function customers()
    {
        return $this->belongsTo(Customer::class,'khachhang_id');
    }
    public function products()
    {
        return $this->belongsTo(Product::class,'ma_id');
    }
}
