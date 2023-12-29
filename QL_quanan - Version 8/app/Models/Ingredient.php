<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'nl_id','nl_ten','nl_dvt','nl_tinhtrang','nl_slcl','nl_slsd'
    ];
    
    protected $primaryKey = 'nl_id';
    protected $table = 'nguyenlieu';
}
