<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class UserlistController extends Controller
{
    //
    public function index()
    {
        $users = User::all();

        /*
        $users = $users->filter(function ($val) {
            // 現在ユーザーのID
            $user_id = Auth::id();
            return $val->user_id == $user_id;
        });
        */

        return view('userlist/index', compact('users'));
    }

    public function store(Request $request)
    {
    }
}
