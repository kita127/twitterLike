<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class RefretweetController extends Controller
{
    //
    public function store(Request $request)
    {
        $src_message_id = $request->message_id;
        $message = $request->message;

        // 現在ユーザーのID
        $user_id = Auth::id();

        // 引用リツイートとしてメッセージを作成

        $newMessage = new Message();
        $newMessage->user_id = $user_id;
        $newMessage->message = $message;
        $newMessage->favorite = 0;
        $newMessage->type = 'refretweet';
        $newMessage->message_id = $src_message_id;
        $newMessage->norify_id = -1;
        $newMessage->image = '';
        $newMessage->save();

        return view('dashboard');
    }
}
