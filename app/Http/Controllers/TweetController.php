<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tweet;

class TweetController extends Controller
{
    //
    public function index()
    {
        return view('tweet/index');
    }
}