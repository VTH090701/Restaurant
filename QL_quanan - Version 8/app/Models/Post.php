<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'baiviet_id','baiviet_tieude','baiviet_tomtat','baiviet_noidung','baiviet_tinhtrang','baiviet_hinhanh','nv_id','baiviet_tgd','baiviet_tgcn'
    ];
    protected $primaryKey = 'baiviet_id';
    protected $table = 'baiviet';

   public function admins()
    {
        return $this->belongsTo(Admin::class,'nv_id');
    }
}
