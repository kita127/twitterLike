<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Follow;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TimelineController extends Controller
{
    //
    public function index()
    {

        // フォロワーのidと自分のidを取得
        $ids = Follow::where('user_id', '=', Auth::id())->get()->map(function ($item) {
            return $item->following_user_id;
        });
        $ids->push(Auth::id());

        // タイムラインに表示するメッセージ
        $messages = Message::whereIn('user_id', $ids->toArray())->get();

        return view('timeline/index', compact('messages'));
    }
}
