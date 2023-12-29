<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quantitative extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'dl_id','ma_id','dl_dvt','dl_trangthai'
    ];
    protected $primaryKey = 'dl_id';
    protected $table = 'dinhluong';

    public function product()
    {
        return $this->belongsTo(Product::class,'ma_id');
    }
    public function quantitativedetails()
    {
        return $this->hasMany(Detailsquantitative::class,'dl_id');
    }

}
