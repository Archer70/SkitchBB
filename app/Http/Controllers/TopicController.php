<?php

namespace App\Http\Controllers;

use App\Board;
use App\Post;
use App\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class TopicController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
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
    public function create(Board $board)
    {
        if (auth()->user()->cant('create', Topic::class)) {
            return Redirect::route('users.permission_denied');
        }
        return view('topic_create', ['board' => $board]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Board $board, Request $request)
    {
        if (auth()->user()->cant('create', Topic::class)) {
            return Redirect::route('users.permission_denied');
        }
        $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $user = $request->user();

        $topic = new Topic();
        $topic->board_id = $board->id;
        $topic->user_id = $user->id;
        $topic->title = $request->title;
        $topic->save();

        $post = new Post();
        $post->user_id = 1;
        $post->category_id = $board->category->id;
        $post->board_id = $board->id;
        $post->topic_id = $topic->id;
        $post->body = $request->body;
        $post->save();

        $topic->first_post_id = $post->id;
        $topic->last_post_id = $post->id;
        $topic->save();

        $user->post_count++;
        $user->save();

        return Redirect::route('topics.show', ['topic' => $topic, 'slug' => $topic->slug]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Topic $topic)
    {
        $user = auth()->user();
        if ($user->cant('view', $topic)) {
            return Redirect::route('users.permission_denied');
        }
        
        $posts = $topic->posts()->with(['board', 'user', 'user.group'])->paginate(20);
        foreach ($posts as $post) {
            $post->can_update = $user->can('update', $post);
            $post->can_delete = $user->can('delete', $post);
        }

        $topic->markRead($user);

        return view('topic', ['authUser' => auth()->user(), 'topic' => $topic, 'posts' => $posts]);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param Topic $topic
     * @return \Illuminate\Http\Response
     */
    public function edit(Topic $topic)
    {
        if (auth()->user()->cant('update', $topic)) {
            return Redirect::route('users.permission_denied');
        }

        return view('topic_edit', ['topic' => $topic, 'board' => $topic->board]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Topic $topic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Topic $topic)
    {
        if (auth()->user()->cant('update', $topic)) {
            return Redirect::route('users.permission_denied');
        }
        $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $topic->title = $request->title;
        $topic->firstPost->update(['body' => $request->body]);
        $topic->save();

        return redirect()->route('topics.show', ['topic' => $topic, 'slug' => $topic->slug]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Topic $topic)
    {
        if (auth()->user()->cant('delete', $topic)) {
            return Redirect::route('users.permission_denied');
        }
        $redirectBoard = $topic->board->id;
        $redirectSlug = $topic->board->slug;

        $topic->markUnread();

        $topic->posts()->delete();
        $topic->delete();

        return Redirect::route('boards.show', ['board' => $redirectBoard, 'slug' => $redirectSlug]);
    }
}
