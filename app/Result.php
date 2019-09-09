<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $table = "results";

    protected $fillable = ['winner_id', 'loser_id', 'result', 'date'];

    public function winners() {
        return $this->belongsTo('App\User', 'winner_id', 'id');
    }

    public function losers() {
        return $this->belongsTo('App\User', 'loser_id', 'id');
    }
}
