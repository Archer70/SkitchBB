<?php

return [
    'user' => [
        'App\Category' => [
            'show' => 'all',
            'create' => 'none',
            'edit' => 'none',
            'destroy' => 'none',
        ],
        'App\Board' => [
            'show' => 'all',
            'create' => 'none',
            'edit' => 'none',
            'destroy' => 'none',
        ],
        'App\Topic' => [
            'show' => 'all',
            'create' => 'all',
            'edit' => 'own',
            'destroy' => 'own',
        ],
        'App\Post'  => [
            'show' => 'all',
            'create' => 'all',
            'edit' => 'own',
            'destroy' => 'own',
        ],
        'App\User' => [
            'show' => 'all',
            'create' => 'own',
            'edit' => 'own',
            'destroy' => 'own',
        ],
    ],
    'admin' => [
        'App\Category' => [
            'show' => 'all',
            'create' => 'all',
            'edit' => 'all',
            'destroy' => 'all',
        ],
        'App\Board' => [
            'show' => 'all',
            'create' => 'all',
            'edit' => 'all',
            'destroy' => 'all',
        ],
        'App\Topic' => [
            'show' => 'all',
            'create' => 'all',
            'edit' => 'all',
            'destroy' => 'all',
        ],
        'App\Post'  => [
            'show' => 'all',
            'create' => 'all',
            'edit' => 'all',
            'destroy' => 'all',
        ],
        'App\User' => [
            'show' => 'all',
            'create' => 'all',
            'edit' => 'all',
            'destroy' => 'all',
        ],
    ],
    'global_moderator' => [
        'app\Category' => [
            'show' => 'all',
            'create' => 'none',
            'edit' => 'none',
            'destroy' => 'none',
        ],
        'App\Board' => [
            'show' => 'all',
            'create' => 'none',
            'edit' => 'none',
            'destroy' => 'none',
        ],
        'App\Topic' => [
            'show' => 'all',
            'create' => 'all',
            'edit' => 'all',
            'destroy' => 'all',
        ],
        'App\Post'  => [
            'show' => 'all',
            'create' => 'all',
            'edit' => 'all',
            'destroy' => 'all',
        ],
        'App\User' => [
            'show' => 'all',
            'create' => 'all',
            'edit' => 'all',
            'destroy' => 'all',
        ],
    ],
];