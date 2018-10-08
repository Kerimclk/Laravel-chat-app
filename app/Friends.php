<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friends extends Model
{
    protected $table = 'friends';
    protected $fillable=['request_sender','request_receiver','confirm'];

    function users(){
    	return $this->belongsTo('App\User');
    }
}
