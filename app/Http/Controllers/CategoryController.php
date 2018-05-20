<?php

namespace App\Http\Controllers;

use App\Policies\CategoryPolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use App\Category;

class CategoryController extends Controller
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
    public function create()
    {
        if (auth()->user()->cant('create', Category::class)) {
            return Redirect::route('users.permission_denied');
        }
        return view('category_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (auth()->user()->cant('create', Category::class)) {
            return Redirect::route('users.permission_denied');
        }
        $request->validate([
            'title' => 'required',
            'description' => 'nullable'
        ]);

        Category::create([
            'title' => $request->title, 'description' => $request->description
        ]);

        return Redirect::route('home');
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
    public function edit(Category $category)
    {
        return view('category_edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Category $category
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Category $category, Request $request)
    {
        if (auth()->user()->cant('update', $category)) {
            return Redirect::route('users.permission_denied');
        }
        $request->validate([
            'title' => 'required',
            'description' => 'nullable'
        ]);
        $category->title = $request->title;
        $category->description = $request->description;
        $category->save();
        return redirect()->route('home');
    }

    public function moveUp(Category $category)
    {
        if (auth()->user()->cant('update', $category)) {
            return Redirect::route('users.permission_denied');
        }
        if ($category->order == 1) { // Don't be an idiot.
            return redirect()->route('home');
        }

        $categoryToIncrement = Category::where('order', --$category->order)->first();

        $categoryToIncrement->order++;
        $categoryToIncrement->save();
        $category->save();

        return redirect()->route('home');
    }

    public function moveDown(Category $category)
    {
        if (auth()->user()->cant('update', $category)) {
            return Redirect::route('users.permission_denied');
        }
        $lastCategory = Category::orderBy('order', 'desc')->first();
        if ($category->order == $lastCategory->order) { // Don't be an idiot.
            return redirect()->route('home');
        }

        $categoryToDecrement = Category::where('order', ++$category->order)->first();

        $categoryToDecrement->order--;
        $categoryToDecrement->save();
        $category->save();

        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if (auth()->user()->cant('delete', $category)) {
            return Redirect::route('users.permission_denied');
        }

        $boardIds = $this->getIdsFromDbResult(
            DB::table('boards')
                ->select('id')
                ->where('category_id', $category->id)
                ->get()
        );
        $topicIds = $this->getIdsFromDbResult(
            DB::table('topics')
                ->select('id')
                ->whereIn('board_id', $boardIds)
                ->get()
        );
        $postIds = $this->getIdsFromDbResult(
            DB::table('posts')
                ->select('id')
                ->whereIn('topic_id', $topicIds)
                ->get()
        );

        DB::table('posts')
            ->whereIn('id', $postIds)
            ->delete();
        DB::table('topics')
            ->whereIn('id', $topicIds)
            ->delete();
        DB::table('boards')
            ->whereIn('id', $boardIds)
            ->delete();

        $category->delete();

        return redirect()->route('home');
    }

    private function getIdsFromDbResult($result)
    {
        $ids = [];
        foreach ($result as $item) {
            $ids[] = $item->id;
        }
        return $ids;
    }
}
