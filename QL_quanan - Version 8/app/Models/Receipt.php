<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'pnh_id','nv_id','pnh_ngaylapphieu','pnh_thanhtien','pnh_ghichu','pnh_ngayxacnhan','pnh_tinhtrang'
    ];
    protected $primaryKey = 'pnh_id';
    protected $table = 'phieunhaphang';
    
    public function admins()
    {
        return $this->belongsTo(Admin::class,'nv_id');
    }

    public function receiptdetails()
    {
        return $this->hasMany(Detailsreceipt::class,'pnh_id');
    }
    public function suppliers()
    {
        return $this->belongsTo(Supplier::class,'ncc_id');
    }
}
