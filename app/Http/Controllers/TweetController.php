<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class TweetController extends Controller
{
    //
    public function index()
    {
        return view('tweet/index');
    }

    public function store(Request $request)
    {
        // 現在ユーザーのID
        $user_id = Auth::id();

        $newMessage = new Message();
        $newMessage->user_id = $user_id;
        $newMessage->message = $request->message;
        $newMessage->favorite = 0;
        $newMessage->type = 'tweet';
        $newMessage->message_id = -1;
        $newMessage->norify_id = -1;
        $newMessage->image = '';
        $newMessage->save();
        return view('dashboard');
    }
}
