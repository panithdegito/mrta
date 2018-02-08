<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $table = "emails";
    protected $fillable = [
        'receiver_email','receiver_name','sender_name','sender_host','sender_port','sender_username','sender_password','sender_encryption'
    ];
}
