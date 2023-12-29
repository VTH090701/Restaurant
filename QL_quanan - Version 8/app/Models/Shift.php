<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'nv_id','phienlamviec_tt','phienlamviec_dt','phienlamviec_id','phienlamviec_gc','phienlamviec_tc','phienlamviec_tgbd','phienlamviec_tgkt'
    ];
    protected $primaryKey = 'phienlamviec_id';
    protected $table = 'phienlamviec';
    
    public function admins()
    {
        return $this->belongsTo(Admin::class,'nv_id');
    }
    public function orders()
    {
        return $this->hasMany(Order::class,'phienlamviec_id');
    }
    public function detailsshifts()
    {
        return $this->hasMany(Detailsshift::class,'phienlamviec_id');
    }
}
