<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('order')->with(['boards'])->get();
        return view('home', [
            'categories' => Category::orderBy('order')->with(['boards'])->get(),
            'authUser' => auth()->user(),
            'lastCategoryId' => $categories->last()->id
        ]);
    }
}
