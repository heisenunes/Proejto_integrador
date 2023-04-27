<?php

namespace App\Http\Controllers;

use App\Models\FinishedTopic;
use App\Models\Topic;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
  /*  public function show()
    {
        $topics = Topic::orderBy('order_id', 'asc')->get();

        $finishedTopics = [];
        if (Auth::check()) {
            $finishedTopics = FinishedTopic::where('user_id', Auth::user()->id)->select("topic_id");
        }

        return view('pages.home', ['topics' => $topics, 'finishedTopics' => $finishedTopics]);

    }
    */
}
