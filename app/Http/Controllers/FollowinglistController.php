<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FollowinglistController extends Controller
{
    //
    public function index()
    {
        /*
        $all_users = User::all();

        // 自分以外のユーザー一覧取得
        $users = $all_users->filter(function ($val) {
            $user_id = Auth::id();
            return $val->id != $user_id;
        });

        */
        return view('followinglist/index');
    }

    public function store(Request $request)
    {
        /*
        $following_id = $request->following_id;

        $newFollow = new Follow();

        // 自分のID
        $newFollow->user_id = Auth::id();
        $newFollow->following_user_id = $following_id;
        $newFollow->save();

        */
        return view('dashboard');
    }
}
