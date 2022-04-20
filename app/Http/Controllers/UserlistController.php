<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
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

    public function store(Request $request)
    {
    }
}
