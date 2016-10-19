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
}
