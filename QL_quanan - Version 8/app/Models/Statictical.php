<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statictical extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'thongke_id','thongke_ngay','thongke_dt','thongke_sl','thongke_thd','thongke_cp'
    ];
    protected $primaryKey = 'thongke_id';
    protected $table = 'thongke';

}
