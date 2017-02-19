<?php

namespace App\Orm;

use Illuminate\Database\Eloquent\Model;

class Links extends Model
{
    protected $table = 'links';
    protected $primaryKey = 'links_id';
    public $timestamps = false;
    protected $guarded = [];
}
