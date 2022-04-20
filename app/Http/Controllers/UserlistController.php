<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Follow;
use Illuminate\Support\Facades\Auth;

class UserlistController extends Controller
{
    //
    public function index()
    {
        $all_users = User::all();

        // 自分以外のユーザー一覧取得
        $users = $all_users->filter(function ($val) {
            $user_id = Auth::id();
            return $val->id != $user_id;
        });

        return view('userlist/index', compact('users'));
    }

    // Follow 情報追加
    public function store(Request $request)
    {
        $following_id = $request->following_id;

        $newFollow = new Follow();

        // 既に登録済みの場合は登録しない
        $res = Follow::where([
            ['user_id', '=', Auth::id()],
            ['following_user_id', '=', $following_id],
        ]);

        if ($res->count() == 0) {
            // 自分のID
            $newFollow->user_id = Auth::id();
            $newFollow->following_user_id = $following_id;
            $newFollow->save();
        }

        return view('dashboard');
    }
}
