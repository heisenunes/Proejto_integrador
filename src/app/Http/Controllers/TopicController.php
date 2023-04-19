<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Topic;
use App\Models\TopicVisits;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopicController extends Controller
{
    public function show($id)
    {
        $topic = Topic::find($id);
        // dd($topic);
        if ($topic != null) {
            Topic::where('id', $topic->id);

            if (TopicVisits::where(['day' => date("Y-m-d"), 'topic_id' => $id])->exists()) {
                // If entry for today exists, increment count
                $topic_visit = TopicVisits::where(['day' => date("Y-m-d"), 'topic_id' => $id])->first();
                $topic_visit->increment('count');
                $topic_visit->save();
            } else {
                // User session does not exist
                $topic_visit = TopicVisits::create([
                    'topic_id' => $id,
                    'day' => date("Y-m-d"),
                    'count' => 1,
                ]);
                $topic_visit->save();
            }

            return view('pages.topic', ['topic' => $topic]);
        }
        return back();
    }

    public function editTopic(Request $request, Topic $topic): RedirectResponse
    {

        if ($request->title !== $topic->title && $request->title !== null) {
            $this->validate($request, [
                'title' => 'required|string|min:3|max:32',
            ]);

            $topic->title = $request->title;
            $topic->save();
        }


        $imageFile = $request->file('homepageImage');
        if ($imageFile !== null) {
            $imagePath = "/img/topic_logo/homepage/" . $imageFile->getClientOriginalName();
            $imageFile->move(base_path('public/img/topic_logo/homepage'), $imageFile->getClientOriginalName());

            $createdImage = Image::create([
                'path' => $imagePath,
            ]);

            $topic->homepage_image_id = $createdImage->id;
        }


        $iconFile = $request->file('iconImage');
        if ($iconFile !== null) {
            $iconPath = "/img/topic_logo/icons/" . $iconFile->getClientOriginalName();
            $iconFile->move(base_path('public/img/topic_logo/icons'), $iconFile->getClientOriginalName());

            $createdIcon = Image::create([
                'path' => $iconPath,
            ]);

            $topic->icon_image_id = $createdIcon->id;

        }

        $topic->save();

        return back();
    }

    public function createTopic(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'title' => 'required|string|min:3|max:32',
            'brief' => 'required|string|max:200',
        ]);

        $last = Topic::latest('order_id')->first();
        $nextId = $last->order_id + 1;

        $topicCreated = Topic::create([
            'order_id' => $nextId,
            'title' => $request->input('title'),
            'brief' => $request->input('brief'),
            'homepage_image_id' => 1,
            'icon_image_id' => 1,
        ]);

        $imageFile = $request->file('homepageImage');
        $title = $request->input('title');

        if ($imageFile != null) {
            $imagePath = "/img/topic_logo/homepage/" . $imageFile->getClientOriginalName();
            $imageFile->move(base_path('public/img/topic_logo/homepage'), $imageFile->getClientOriginalName());

            $createdImage = Image::create([
                'path' => $imagePath,
            ]);
            $topicCreated->homepage_image_id = $createdImage->id;
        }

        $iconFile = $request->file('iconImage');
        if ($iconFile !== null) {
            $iconPath = "/img/topic_logo/icons/" . $iconFile->getClientOriginalName();
            $iconFile->move(base_path('public/img/topic_logo/icons'), $iconFile->getClientOriginalName());

            $createdIcon = Image::create([
                'path' => $iconPath,
            ]);

            $topicCreated->icon_image_id = $createdIcon->id;

        }
        $topicCreated->save();

        return redirect()->route('topic.get', $topicCreated);
    }

    public function quiz(Topic $topic): RedirectResponse
    {
        $question = Auth::user()->getFirstUnansweredQuestion($topic);
        if ($question) {
            return redirect()->route('show_question', $question);
        }

        return redirect()->route('home')->withSuccess('Tópico Terminado');
    }

    function changeTopicUp(Topic $topic): RedirectResponse
    {
        $temp = $topic->order_id;
        if ($temp != 1) {
            $otherTopic = Topic::where('order_id', '<', $topic->order_id)
                ->orderBy('order_id', 'desc')->first();


            $topic->order_id = $otherTopic->order_id;
            $topic->save();
            $otherTopic->order_id = $temp;
            $otherTopic->save();

            return back();
        }
        return back();
    }

    function changeTopicDown(Topic $topic): RedirectResponse
    {
        $temp = $topic->order_id;
        $last = Topic::latest('order_id')->first();
        if ($temp != $last->order_id) {
            $otherTopic = Topic::where('order_id', '>', $topic->order_id)
                ->orderBy('order_id', 'asc')->first();


            $topic->order_id = $otherTopic->order_id;
            $topic->save();
            $otherTopic->order_id = $temp;
            $otherTopic->save();

            return back();
        }
        return back();
    }

    function changeTopicActive(Topic $topic): RedirectResponse
    {
        $topic->active = !$topic->active;
        $topic->save();

        return back();
    }

    function deleteTopic(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!auth()->attempt($request->only('email', 'password'))) {
            return back()->with('status', 'Credenciais Incorrectas');
        }

        $topic = Topic::firstWhere('id', $request->topicId);

        $otherTopics = Topic::where('order_id', '>', $topic->order_id)->get();

        foreach ($otherTopics as $popTopic) {
            $popTopic->order_id--;
            $popTopic->save();
        }

        // $answers = $topic->questions()->answers()->get();

        $questions = $topic->questions()->get();
        foreach ($questions as $delQuestion) {
            $delQuestion->answers()->delete();
        }

        $topic->finishedTopics()->delete();
        $topic->questions()->delete();
        $topic->posts()->delete();
        $topic->delete();
        return back();
    }
}
