<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'datban_ten','datban_email','datban_sdt','datban_thoigian','datban_slnguoi','ban_id','khachhang_id','datban_tinhtrang','datban_kt'
    ];
    protected $primaryKey = 'datban_id';
    protected $table = 'datban';


    protected $dates = [
        'datban_thoigian'
    ];
    public function table()
    {
        return $this->belongsTo(Table::class,'ban_id');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class,'khachhang_id');
    }
}
