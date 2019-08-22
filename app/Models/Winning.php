<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;

class Winning extends \Eloquent {

    protected $table = 'winnings';

    protected $fillable = [
        'name', 'number'
    ];

}
