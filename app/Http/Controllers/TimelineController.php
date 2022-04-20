<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Timeline;

class TimelineController extends Controller
{
    //
    public function index()
    {
        return view('timeline/index');
    }
}
