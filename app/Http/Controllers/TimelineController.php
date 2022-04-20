<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class TimelineController extends Controller
{
    //
    public function index()
    {
        $messages = Message::all();

        return view('timeline/index', compact('messages'));
    }
}
