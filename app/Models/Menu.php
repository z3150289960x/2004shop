<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'p_users';
    public $timestamps = false;
    protected $primaryKey = 'user_id';
    protected $guarded = [];   //黑名单  create只需要开启
}
