<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'ncc_ten','ncc_sdt','ncc_email','ncc_diachi'
    ];
    protected $primaryKey = 'ncc_id';
    protected $table = 'nhacungcap';
  
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
