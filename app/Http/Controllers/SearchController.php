<?php

namespace App\Http\Controllers;

use App\Topic;
use App\User;
use App\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function create(Request $request)
    {
        $request->validate(['search' => 'required']);

        $users = User::search($request->search)->get();
        $topics = Topic::search($request->search)->get();
        $posts = Post::search($request->search)->get();

        return view('search_results', [
            'users' => $users,
            'topics' => $topics,
            'posts' => $posts
        ]);
    }
}
