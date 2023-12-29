<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detailsreceipt extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'ctnh_id', 'pnh_id', 'ctnh_soluong', 'ctnh_dongia', 'ncc_id','nl_id'
    ];
    protected $primaryKey = 'ctnh_id';
    protected $table = 'ctphieunhaphang';


    public function suppliers()
    {
        return $this->belongsTo(Supplier::class,'ncc_id');
    }
    public function ingredients()
    {
        return $this->belongsTo(Ingredient::class,'nl_id');
    }
}
