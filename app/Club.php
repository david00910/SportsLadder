<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Address;

class Club extends Model
{

    protected $table = 'clubs';

    protected $fillable = [
        'name',
        'foundation_date'
    ];

    public function ownerUser() {
        return $this->belongsTo('App\User', 'owner');
    }

    public function clubAddress() {
        return $this->belongsTo('App\Address', 'address_id')->with('zipcode');
    }


}
