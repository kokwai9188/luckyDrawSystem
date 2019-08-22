<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Users extends Authenticatable {

    protected $table = 'users';

    public function draw()
    {
        return $this->hasMany('App\Models\Draw_number');
    }

}
