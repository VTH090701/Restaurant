<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mailsettings extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'mail_id','mail_transport','mail_host','mail_port','mail_user','mail_password','mail_encryption','mail_from'
    ];
    protected $primaryKey = 'mail_id';
    protected $table = 'mailsettings';
}
