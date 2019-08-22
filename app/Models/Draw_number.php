<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;

class Draw_number extends \Eloquent {

    protected $table = 'draw_numbers';

    public function user()
    {
        return $this->belongsTo('App\Models\Users');
    }

}
