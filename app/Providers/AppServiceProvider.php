<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        Relation::enforceMorphMap([
            'user' => 'App\Models\User',
            'post' => 'App\Models\Post',
            'comment' => 'App\Models\Comment'
        ]);
    }
}
