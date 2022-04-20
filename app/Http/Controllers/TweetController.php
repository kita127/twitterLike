<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;
use App\Models\Norify;
use Illuminate\Support\Facades\Auth;

class TweetController extends Controller
{
    //
    public function index()
    {
        return view('tweet/index');
    }

    public function store(Request $request)
    {
        // 現在ユーザーのID
        $user_id = Auth::id();

        $newMessage = new Message();
        $newMessage->user_id = $user_id;
        $newMessage->message = $request->message;
        $newMessage->favorite = 0;
        $newMessage->type = 'tweet';
        $newMessage->message_id = -1;
        $newMessage->norify_id = -1;
        $newMessage->image = '';
        $newMessage->save();


        // リプライがある場合作成する
        $to_replays = $this->getReplys($newMessage->message);
        if (count($to_replays) > 0) {
            foreach ($to_replays as $to_replay) {
                $newNorify = new Norify();
                $newNorify->to_user_id = $this->get_userid_by_name($to_replay);
                $newNorify->from_user_id = $user_id;
                $newNorify->message_id = $newMessage->id;
                $newNorify->save();
            }
        }

        return view('dashboard');
    }

    private function get_userid_by_name($user_name)
    {
        return User::where('name', '=', $user_name)->get()->first()->id;
    }

    private function getReplys($str)
    {
        $all_users = User::all();
        $all_user_names = $all_users->map(function ($var) {
            return $var->name;
        });

        $to_replays = array();

        foreach ($all_user_names as $un) {
            if (strpos($str, '@' . $un) !== false) {
                // 含まれる場合
                array_push($to_replays, $un);
            }
        }

        return $to_replays;
    }
}
