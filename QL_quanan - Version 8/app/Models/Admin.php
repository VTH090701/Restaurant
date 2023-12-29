<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Database\Eloquent\Model;
use App\Models\Roles;

class Admin extends Authenticatable
{
    public $timestamps = false;
    protected $fillable = [
        'nv_id','nv_matkhau','nv_ten','nv_sdt','nv_hinhanh','nv_code','nv_timecode','nv_diachi','nv_tinhtrang','nv_token'
    ];
    protected $primaryKey = 'nv_id';
    protected $table = 'nhanvien';

    public function roles(){
        return $this->belongsToMany('App\Models\Roles','ctquyen','quyen_id','nv_id');
    }

    public function getAuthPassword()
    {
        return $this->nv_matkhau;
    }
    
    public function hasAnyRoles($roles){
        return null !== $this->roles()->whereIn('quyen_ten',$roles)->first();

    }
    public function hasRole($roles){
        return null !== $this->roles()->where('quyen_ten',$roles)->first();
    }
}
