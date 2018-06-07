<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('order')->with(['boards' => function($query) {
            $query->orderBy('order');
        }])->get();
        $usersOnline = User::where('last_seen', '>=', Carbon::now()->subMinutes(10))
            ->orderBy('name')
            ->get();
        $usersOnlineLinks = [];
        foreach ($usersOnline as $user) {
            $usersOnlineLinks[] = '<a href="'. route('users.show', ['user' => $user]). '">'. htmlspecialchars($user->name, ENT_QUOTES). '</a>';
        }
        return view('home', [
            'categories' => $categories,
            'lastCategory' => $categories->last(),
            'usersOnlineLinks' => $usersOnlineLinks,
        ]);
    }
}
