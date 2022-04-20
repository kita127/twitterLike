<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;


class RetweetController extends Controller
{
    //
    public function store(Request $request)
    {
        $message_id = $request->message_id;

        // 現在ユーザーのID
        $user_id = Auth::id();

        // リツイートとしてメッセージを作成

        $newMessage = new Message();
        $newMessage->user_id = $user_id;
        $newMessage->message = '';
        $newMessage->favorite = 0;
        $newMessage->type = 'retweet';
        $newMessage->message_id = $message_id;
        $newMessage->norify_id = -1;
        $newMessage->image = '';
        $newMessage->save();

        return view('dashboard');
    }

}
