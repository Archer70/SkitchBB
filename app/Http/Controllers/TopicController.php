<?php

namespace App\Http\Controllers;

use App\Board;
use App\Post;
use App\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TopicController extends Controller
{
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
    public function create($slug)
    {
        $board = Board::where('slug', $slug)->first();
        return view('topics.create', ['board' => $board]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $board = Board::find($request->board_id);

        $topic = new Topic();
        $topic->slug = str_slug($request->title);
        $topic->board_id = $board->id;
        $topic->user_id = 1;
        $topic->title = $request->title;
        $topic->save();

        $post = new Post();
        $post->user_id = 1;
        $post->topic_id = $topic->id;
        $post->body = $request->body;
        $post->save();

        $topic->first_post_id = $post->id;
        $topic->last_post_id = $post->id;
        $topic->save();

        return Redirect::route('topic.show', ['slug' => $topic->slug]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $topic = Topic::where('slug', $slug)->with('posts')->first();
        return view('topics.show', ['topic' => $topic]);
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