<?php

namespace App\Utils;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

class Menu
{
    public static function buttons()
    {
        $buttons = [
            'home' => [
                'title' => __('Home'),
                'href' => route('home'),
            ],
            'feed' => [
                'title' => __('Post Feed'),
                'href' => route('feed'),
            ],
        ];

        if (Auth::user()) {
            $buttons['users.show'] = [
                'title' => __('Profile'),
                'href' => route('users.show', ['name' => Auth::user()->name]),
            ];

            $buttons['logout'] = [
                'title' => __('Logout'),
                'href' => route('logout'),
                'type' => 'form',
            ];
        } else {
            $buttons['login'] = [
                'title' => __('Login'),
                'href' => route('login'),
            ];

            $buttons['register'] = [
                'title' => __('Register'),
                'href' => route('register'),
            ];
        }

        foreach ($buttons as $key => $button) {
            $buttons[$key]['current'] = Route::currentRouteName() == $key;
        }

        return $buttons;
    }
}