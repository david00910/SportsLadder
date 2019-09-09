<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Club extends Model
{

    protected $table = 'clubs';

    protected $fillable = [
        'name',
        'foundation_date'
    ];


}
