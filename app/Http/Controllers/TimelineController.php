<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Follow;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Msg
{
    public $id;
    public $name;
    public $message;
    public $favorite;
}

class TimelineController extends Controller
{
    //
    public function index()
    {

        $join_table = DB::table('messages')->join('users', 'users.id', '=', 'messages.user_id')
            ->select('messages.id', 'messages.message', 'messages.favorite', 'users.id as user_id', 'users.name', 'messages.message_id', 'messages.type')
            ->get();

        // フォロワーのidと自分のidを取得
        $ids = Follow::where('user_id', '=', Auth::id())->get()->map(function ($item) {
            return $item->following_user_id;
        });
        $ids->push(Auth::id());

        // タイムラインに表示するメッセージ
        $messages = $join_table->whereIn('user_id', $ids->toArray());

        // リツイートの処理
        $message_and_retweet = new \Illuminate\Support\Collection();
        foreach ($messages as $message) {
            $msg = new Msg();
            $msg->id = $message->id;
            $msg->name = $message->name;
            $msg->message = $message->message;
            $msg->favorite = $message->favorite;
            if ($message->type == 'retweet') {
                // リツイートの場合はリツイートメッセージと置き換え
                $retweeter = $message->name;
                // リツイート元のメッセージ
                $src_msg = $join_table->where('id', '=', $message->message_id)->first();
                $msg->id = $src_msg->id;
                $msg->name = $src_msg->name;
                $msg->message = $src_msg->message . '(' . $retweeter . 'がリツイート)';
                $msg->favorite = $src_msg->favorite;
            } elseif ($message->type == 'refretweet') {
                $retweeter = $message->name;
                // リツイート元のメッセージ
                $src_msg = $join_table->where('id', '=', $message->message_id)->first();
                $msg->id = $src_msg->id;
                $msg->name = $src_msg->name;
                $msg->message = $message->message . '>>>' . $src_msg->message . '(' . $retweeter . 'が引用リツイート)';
                $msg->favorite = $src_msg->favorite;
            }

            $message_and_retweet->push($msg);
        }

        return view('timeline/index', compact('message_and_retweet'));
    }
}
