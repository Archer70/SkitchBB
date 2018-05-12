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
        if ($request->search) {
            $searchTerm = $request->search;
        } elseif ($request->session()->has('search')) {
            $searchTerm = $request->session()->get('search');
        } else {
            return redirect()->back();
        }
        $request->session()->flash('search', $searchTerm);

        $posts = Post::search($searchTerm)->paginate(20);

        return view('search_results', [
            'posts' => $posts
        ]);
    }
}
