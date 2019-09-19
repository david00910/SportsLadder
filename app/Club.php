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

    public function owner() {
        return $this->belongsTo('App\User', 'owner');
    }

    public function address() {
        return $this->hasOne('App\Address', 'id');
    }

}
