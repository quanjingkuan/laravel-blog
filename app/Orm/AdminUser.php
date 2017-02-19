<?php

namespace App\Orm;

use Illuminate\Database\Eloquent\Model;

class AdminUser extends Model
{
    protected $table = 'user';
    public $timestamps = false;
    protected $fillable = [
        'username', 'password',
    ];

}
