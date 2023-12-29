<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'nv_id','ban_id','khachhang_id','hoadon_tinhtrang','hoadon_tongtien','hoadon_ghichu','hoadon_id','hoadon_httt','created_at','shift_id','hoadon_ngaytao','gg_id','phienlamviec_id'
    ];
    protected $primaryKey = 'hoadon_id';
    protected $table = 'hoadon';

    public function customers()
    {
        return $this->belongsTo(Customer::class,'khachhang_id');
    }
    public function table()
    {
        return $this->belongsTo(Table::class,'ban_id');
    }
    public function admins()
    {
        return $this->belongsTo(Admin::class,'nv_id');
    }
    public function tables()
    {
        return $this->belongsTo(Table::class,'ban_id');
    }
    public function shifts()
    {
        return $this->belongsTo(Shift::class,'phienlamviec_id');
    }
    public function coupons()
    {
        return $this->belongsTo(Coupon::class,'gg_id');
    }
    public function orderdetails()
    {
        return $this->hasMany(Orderdetails::class,'hoadon_id');
    }
    
}
