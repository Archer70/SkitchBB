<?php

namespace App\Http\Controllers;

use App\Post;
use App\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show', 'feed', 'index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (auth()->user()->cant('create', Post::class)) {
            return Redirect::route('users.permission_denied');
        }
        $request->validate([
            'topic_id' => 'required',
            'body' => 'required'
        ]);

        $topic = Topic::find($request->topic_id);
        $user = $request->user();

        $post = new Post();
        $post->topic_id = $request->topic_id;
        $post->category_id = $topic->board->category->id;
        $post->board_id = $topic->board_id;
        $post->user_id = $user->id;
        $post->approved = 1;
        $post->body = $_POST['body']; // Because $request->body is apparently a "special" attribute. !TODO Rename this.
        $post->save();

        $user->post_count++;
        $user->save();

        return Redirect::route('topics.show', ['topic' => $topic, 'slug' => $topic->slug]);
    }

    /**
     * Show some of the latest posts.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function feed(Request $request)
    {
        if (auth()->user()->cant('viewFeed', Post::class)) {
            return Redirect::route('users.permission_denied');
        }

        $posts = Post::where('approved', 1)
            ->orderBy('id', 'desc')
            ->take(20)
            ->get();
        return view('post_feed', ['posts' => $posts]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
