<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Norify;

use Illuminate\Support\Facades\Auth;

class RepInfo
{
    public $message;
}

class NotifyController extends Controller
{
    //
    public function index()
    {
        // 自分宛ての通知を抽出
        $to_me_list = Norify::where('to_user_id', '=', Auth::id())->get();

        $replys = array();

        // 自分宛てのメッセージを取得
        foreach ($to_me_list as $rep) {
            $reply = new RepInfo();
            $reply->message = Message::find($rep->message_id)->message;
            array_push($replys, $reply);
        }

        return view('notify/index', compact('replys'));
    }
}
