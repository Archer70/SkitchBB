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
                'title' => __('Feed'),
                'href' => route('feed'),
                'type' => 'dropdown',
                'sub_buttons' => [
                    ['href' => route('feed'), 'title' => __('Latest Posts')],
                ]
            ],
        ];

        if (Auth::check()) {
            $buttons['feed']['sub_buttons'][] = ['href' => route('topics.unread'), 'title' => __('Unread Topics')];
            $buttons['feed']['sub_buttons'][] = ['href' => route('topics.unread-replies'), 'title' => __('Unread Replies')];
            
            $buttons['users.show'] = [
                'title' => __('Profile'),
                'href' => route('users.show', ['user' => Auth::user()]),
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