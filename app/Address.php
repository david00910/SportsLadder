<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = "address";

    protected $fillable = [''];

    public function clubs() {
        return $this->hasMany('App\Club');
    }

    public function zipcode() {
        return $this->belongsTo('App\ZipCode', 'pCode', 'zip');
    }

}
