<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'ma_ten','danhmuc_id','ma_hinhanh','ma_mota','ma_noidung','ma_gia','ma_hinhanh','ma_tinhtrang'
    ];
    protected $primaryKey = 'ma_id';
    protected $table = 'monan';


    // public function scopeSearch($query){
    //     if(request('key')){
    //         $key = request('key');
    //         $query = $query->where('sp_ten','like','%'.$key.'%');
    //     }
    //     if(request('cat_id')){
    //         $query = $query->where('danhmuc_id',request('cat_id'));
    //     }
    //     return $query;
    // }
}
