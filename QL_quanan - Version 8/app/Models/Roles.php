<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin;

class Roles extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'quyen_ten','quyen_id'
    ];
    protected $primaryKey = 'quyen_id';
    protected $table = 'quyen';

    public function admin(){
        return $this->belongsToMany('App\Models\Admin','ctquyen','quyen_id','nv_id');
    }
}
