<?php

namespace App\Orm;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $table = 'conf';
    protected $primaryKey = 'conf_id';
    public $timestamps = false;
    protected $guarded = [];
}
