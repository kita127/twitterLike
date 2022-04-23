<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;
use App\Models\Norify;

use Illuminate\Support\Facades\Auth;

class RepInfo
{
    public $from_name;
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
            $msgrec = Message::find($rep->message_id);
            $reply->message = $msgrec->message;
            $reply->from_name = User::find($msgrec->user_id)->name;
            array_push($replys, $reply);
        }

        return view('notify/index', compact('replys'));
    }
}
