<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Follow;


class FollowinglistController extends Controller
{
    //
    public function index()
    {
        // 自分がフォローしているユーザー一覧を取得する
        
        $following = Follow::where('user_id', '=', Auth::id())->get();
        $following_ids = $following->map(function ($item) {
            return $item->following_user_id;
        });
        $all_users = User::all();
        $following_users = array();
        foreach ($all_users as $user) {
            if (in_array($user->id, $following_ids->toArray())) {
                array_push($following_users, $user);
            }
        }

        return view('followinglist/index', compact('following_users'));
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
