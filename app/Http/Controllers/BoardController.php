<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Board;
use App\Category;
use Illuminate\Support\Facades\Redirect;

class BoardController extends Controller
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
     * @param \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function create(Category $category)
    {
        return view('board_create', ['category' => $category]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Category $category
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Category $category, Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
        ]);

        $board = new Board();
        $board->title = $request->title;
        $board->description = $request->description;
        $board->category()->associate($category);
        $board->save();

        return Redirect::route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $board = Board::where('slug', $slug)
            ->with(['topics.user', 'topics.firstPost', 'topics.lastPost'])
            ->first();
        return view('board', ['board' => $board]);
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
