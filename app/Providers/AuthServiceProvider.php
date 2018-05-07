<?php

namespace App\Providers;

use App\Board;
use App\Category;
use App\Policies\BoardPolicy;
use App\Policies\CategoryPolicy;
use App\Policies\PostPolicy;
use App\Policies\TopicPolicy;
use App\Policies\UserPolicy;
use App\Post;
use App\Topic;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        Category::class => CategoryPolicy::class,
        Board::class => BoardPolicy::class,
        Topic::class => TopicPolicy::class,
        Post::class => PostPolicy::class,
        User::class => UserPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
