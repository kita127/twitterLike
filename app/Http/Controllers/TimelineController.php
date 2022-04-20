<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Follow;
use Illuminate\Support\Facades\DB;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TimelineController extends Controller
{
    //
    public function index()
    {

        $join_table = DB::table('messages')->join('users', 'users.id', '=', 'messages.user_id')
            ->select('messages.id', 'messages.message', 'messages.favorite', 'users.id as user_id', 'users.name')
            ->get();

        // フォロワーのidと自分のidを取得
        $ids = Follow::where('user_id', '=', Auth::id())->get()->map(function ($item) {
            return $item->following_user_id;
        });
        $ids->push(Auth::id());

        // タイムラインに表示するメッセージ
        $messages = $join_table->whereIn('user_id', $ids->toArray());

        return view('timeline/index', compact('messages'));
    }
}
