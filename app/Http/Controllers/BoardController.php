<?php

namespace App\Http\Controllers;

use App\Topic;
use Illuminate\Http\Request;
use App\Board;
use App\Category;
use Illuminate\Support\Facades\Auth;
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
        if (auth()->user()->cant('create', Board::class)) {
            return Redirect::route('users.permission_denied');
        }
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
        if (auth()->user()->cant('create', Board::class)) {
            return Redirect::route('users.permission_denied');
        }
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
        ]);

        $lastOrderNumber = $category->boards->max('order');

        $board = new Board();
        $board->order = $lastOrderNumber + 1;
        $board->title = $request->title;
        $board->description = $request->description;
        $board->category()->associate($category);
        $board->save();

        return Redirect::route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  Board $board
     * @return \Illuminate\Http\Response
     */
    public function show(Board $board)
    {
        if (auth()->user()->cant('view', $board)) {
            return Redirect::route('users.permission_denied');
        }
        $topics = Topic::where('board_id', $board->id)
            ->orderBy('id', 'desc')
            ->paginate(20);
        return view('board', ['board' => $board, 'topics' => $topics]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Board  $board
     * @return \Illuminate\Http\Response
     */
    public function edit(Board $board)
    {
        if (auth()->user()->cant('update', $board)) {
            return Redirect::route('users.permission_denied');
        }
        return view('board_edit', ['board' => $board]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Board  $board
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Board $board)
    {
        if (auth()->user()->cant('update', $board)) {
            return Redirect::route('users.permission_denied');
        }
        $request->validate([
            'title' => 'required'
        ]);

        $board->title = $request->title;
        $board->description = $request->description;
        $board->save();

        return redirect()->route('boards.show', ['board' => $board]);
    }

    public function moveUp(Board $board)
    {
        if (auth()->user()->cant('update', $board)) {
            return Redirect::route('users.permission_denied');
        }
        if ($board->order == 1) { // Don't be an idiot.
            return redirect()->route('home');
        }

        $boardToMoveDown = Board::where([
            ['category_id', '=', $board->category->id],
            ['order', '=', --$board->order]
        ])->first();
        if ($boardToMoveDown) {
            $boardToMoveDown->order++;
            $boardToMoveDown->save();
        }
        $board->save();

        return redirect()->route('home');
    }

    public function moveDown(Board $board)
    {
        if (auth()->user()->cant('update', $board)) {
            return Redirect::route('users.permission_denied');
        }
        $lastBoard = Board::orderBy('order', 'desc')->first();
        if ($board->order == $lastBoard->order) { // Don't be an idiot.
            return redirect()->route('home');
        }

        $boardToMoveUp = Board::where([
            ['category_id', '=', $board->category->id],
            ['order', '=', ++$board->order]
        ])->first();
        if ($boardToMoveUp) {
            $boardToMoveUp->order--;
            $boardToMoveUp->save();
        }
        $board->save();

        return redirect()->route('home');
    }

    public function resetBoardOrder(Category $category)
    {
        $boards = $category->boards;
        for ($i=0; $i<count($boards); $i++) {
            $board = $boards[$i];
            $board->order = $i+1;
            $board->save();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Board  $board
     * @return \Illuminate\Http\Response
     */
    public function destroy(Board $board)
    {
        if (auth()->user()->cant('delete', $board)) {
            return Redirect::route('users.permission_denied');
        }
        $category = $board->category;

        $board->posts()->delete();
        $board->topics()->delete();
        $board->delete();

        $this->resetBoardOrder($category);
        return redirect()->route('home');
    }
}
