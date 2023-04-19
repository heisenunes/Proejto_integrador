<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Topic;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


class PostController extends Controller
{
    public function show($id): Factory|View|Application
    {
        $articles = Post::find($id);
        return view('partials.post', ['post' => $articles]);
    }

    public function createPost(Request $request): RedirectResponse
    {
        $topic = Topic::find($request->input('topic'));
        if (!$topic)
            return back()->withErrors("Topic not found");

        $order_id = $topic->lastPost()?->order_id + 1 ?: 1;

        $this->validate($request, [
            'title' => 'required|string|min:1 max:100',
            'content' => 'required|string|min:1',
        ]);

        $createdPost = Post::create([
            'topic_id' => $topic->id,
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'order_id' => $order_id,
        ]);

        $createdPost->save();

        return redirect()->route('topic.get', $request->input('topic'))->with('success', 'Novo Artigo Criado!');
    }

    function changePostActive(Post $post): RedirectResponse
    {
        $post->active = !$post->active;
        $post->save();

        return back();
    }

    function changePostUp(Post $post): RedirectResponse
    {
        $temp = $post->order_id;
        if ($temp == 1) {
            return back();
        }

        $otherPost = Post::where('topic_id', $post->topic->id)
            ->where('order_id', '<', $post->order_id)
            ->orderBy('order_id', 'desc')->first();

        $post->order_id = $otherPost->order_id;
        $post->save();
        $otherPost->order_id = $temp;
        $otherPost->save();

        return back();
    }

    function changePostDown(Post $post): RedirectResponse
    {
        $temp = $post->order_id;
        $last = Post::where('topic_id', $post->topic->id)->latest('order_id')->first();

        if ($temp != $last->order_id) {
            $otherPost = Post::where('topic_id', $post->topic->id)->where('order_id', '>', $post->order_id)
                ->orderBy('order_id')->first();

            $post->order_id = $otherPost->order_id;
            $post->save();
            $otherPost->order_id = $temp;
            $otherPost->save();

            return back();
        }

        return back();
    }

    function updatePost(Request $request, Post $post): RedirectResponse
    {
        $this->validate($request, [
            'title' => 'required|string|min:1 max:100',
            'content' => 'required|string|min:1',
        ]);

        $newTopic = Topic::find($request->input('topic'));
        if (!$newTopic)
            return back()->withErrors("Topic not found");

        if ($post->topic_id !== $newTopic->id) {
            $post->topic_id = $newTopic->id;
            $post->order_id = $newTopic->lastPost()?->order_id + 1 ?: 1;
        }


        $post->content = $request->input('content');
        $post->title = $request->input('title');
        $post->save();

        return redirect()->route('topic.get', $post->topic_id)->with('success', 'Artigo Foi Editado!');
    }

    function deletePost(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!auth()->attempt($request->only('email', 'password'))) {
            return back()->with('status', 'Credenciais Incorrectas');
        }

        $post = Post::firstWhere('id', $request->input('postId'));

        $otherPosts = Post::where('topic_id', $post->topic_id)->where('order_id', '>', $post->order_id)->get();

        foreach ($otherPosts as $popPost) {
            $popPost->order_id--;
            $popPost->save();
        }

        $post->delete();
        return back();
    }
}
