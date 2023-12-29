<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'ban_ten','ban_tinhtrang','ban_dat','ban_slnguoi'
    ];
    protected $primaryKey = 'ban_id';
    protected $table = 'ban';

    
    public function reservations()
    {
        return $this->hasMany(Reservation::class,'ban_id');
    }

}
