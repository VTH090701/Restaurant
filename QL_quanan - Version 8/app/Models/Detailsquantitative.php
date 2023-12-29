<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detailsquantitative extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'ctdl_id','dl_id','nl_id','ctdl_sl'
    ];
    
    protected $primaryKey = 'ctdl_id';
    protected $table = 'ctdinhluong';
    public function ingredients()
    {
        return $this->belongsTo(Ingredient::class,'nl_id');
    }
}
