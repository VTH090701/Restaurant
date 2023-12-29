<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orderdetails extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'hoadon_id','ma_id','cthoadon_slsp','cthoadon_giasp'
    ];
    protected $primaryKey = 'cthoadon_id';
    protected $table = 'cthoadon';
    // public function product(){
    //     return $this->hasMany('App\Models\Comment');
    // }
    
    public function products()
    {
        return $this->belongsTo(Product::class,'ma_id');
    }
}
