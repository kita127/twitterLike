<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Follow;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DispMsg
{
    public $id;
    public $name;
    public $message;
    public $favorite;
    public $image;
    public $msg_type;
    public $retweeter;
    public $can_retweet;
}

class TimelineController extends Controller
{
    //
    public function index()
    {

        $join_table = DB::table('messages')->join('users', 'users.id', '=', 'messages.user_id')
            ->select('messages.id', 'messages.message', 'messages.favorite', 'users.id as user_id', 'users.name', 'messages.message_id', 'messages.type', 'messages.image')
            ->get();

        // フォロワーのidと自分のidを取得
        $ids = Follow::where('user_id', '=', Auth::id())->get()->map(function ($item) {
            return $item->following_user_id;
        });
        $ids->push(Auth::id());

        // タイムラインに表示するメッセージは自分のメッセージとフォロワーのメッセージのみ
        $messages = $join_table->whereIn('user_id', $ids->toArray());

        // リツイートの処理
        // リツイートの場合はリツイート元のメッセージ情報を表示する
        $message_and_retweet = new \Illuminate\Support\Collection();
        foreach ($messages as $message) {
            $disp_msg = new DispMsg();
            $disp_msg->id = $message->id;
            $disp_msg->name = $message->name;
            $disp_msg->message = $message->message;
            $disp_msg->favorite = $message->favorite;
            $disp_msg->image = $message->image;
            $disp_msg->msg_type = 'tweet';
            $disp_msg->retweeter = '';
            $disp_msg->can_retweet = true;
            if ($message->type == 'retweet' || $message->type == 'refretweet') {
                // リツイートの場合はリツイートメッセージと置き換え
                $retweeter = $message->name;
                // リツイート元のメッセージ
                $src_msg = $join_table->where('id', '=', $message->message_id)->first();
                $disp_msg->id = $src_msg->id;
                $disp_msg->name = $src_msg->name;
                $disp_msg->favorite = $src_msg->favorite;
                $disp_msg->image = $src_msg->image;
                $disp_msg->retweeter = $message->name;
                // 自分のリツイートの場合は再度リツイートできない
                $disp_msg->can_retweet = !($message->user_id == Auth::id());

                if ($message->type == 'retweet') {
                    $disp_msg->message = $src_msg->message . '(' . $retweeter . 'がリツイート)';
                    $disp_msg->msg_type = 'retweet';
                } elseif ($message->type == 'refretweet') {
                    $disp_msg->message = $message->message . '>>>' . $src_msg->message . '(' . $retweeter . 'が引用リツイート)';
                    $disp_msg->msg_type = 'refretweet';
                }
            }
            $message_and_retweet->push($disp_msg);
        }

        return view('timeline/index', compact('message_and_retweet'));
    }
}
