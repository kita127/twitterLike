<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TimelineController extends Controller
{
    //
    public function index()
    {
        $messages = Message::all();

        $messages = $messages->filter(function ($val) {
            // 現在ユーザーのID
            $user_id = Auth::id();
            return $val->user_id == $user_id;
        });

        return view('timeline/index', compact('messages'));
    }
}
