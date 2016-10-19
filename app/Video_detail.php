<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video_detail extends Model
{
    //
    public function video()
    {
    	return $this->belongsTo('App\Video', 'foreign_key');
    }
}
