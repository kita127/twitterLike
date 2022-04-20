<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class FavoriteController extends Controller
{
    //
    public function store(Request $request)
    {
        $message = Message::findOrFail($request->message_id);
        $message->favorite++;
        $message->save();
        return view('dashboard');
    }
}
