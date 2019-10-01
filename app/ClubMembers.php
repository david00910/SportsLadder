<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClubMembers extends Model
{
    protected $table = 'club_members';

    public function clubs() {
        return $this->belongsToMany('App\Club', 'club_members', 'user_id', 'club_id')->withPivot('doa');
    }

}
