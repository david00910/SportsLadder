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

    public function users() {
        return $this->hasOne('App\User', 'id');
    }

    public function addresses() {
        return $this->belongsTo('App\Address', 'address_id', 'id');
    }

}
