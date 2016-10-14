<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class VideoController extends Controller
{
    /**
     * Show the Videos list.
     *
     * @param  int
     * @return Response
     */
    public function show()
    {
        return view('video/index');
    }
}
