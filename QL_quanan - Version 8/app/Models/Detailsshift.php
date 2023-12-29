<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detailsshift extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'ctphien_id','phienlamviec_id','ctphien_motachi','ctphien_sotienchi','created_at','updated_at'
    ];
    protected $primaryKey = 'ctphien_id';
    protected $table = 'ctphienlamviec';

    
}
