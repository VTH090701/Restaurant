<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'danhmuc_ten','danhmuc_mota','danhmuc_tinhtrang','created_at','updated_at'
    ];
    protected $primaryKey = 'danhmuc_id';
    protected $table = 'danhmuc';

    public function products()
    {
        return $this->hasMany(Product::class,'danhmuc_id');
    }

    
}
