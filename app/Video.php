<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    //
    public function detail()
    {
    	return $this->hasOne('App\Video_detail');
    }
    //
    public function user()
    {
    	return $this->hasOne('App\User', 'id');
    }
}
