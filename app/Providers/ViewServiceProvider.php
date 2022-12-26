<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Role;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['users.create', 'users.edit'], function ($view) {
            return $view->with(
                'roles',
                Role::select('id', 'name')->get()
            );
        });


        View::composer(['admin.rates.create', 'rates.edit'], function ($view) {
            return $view->with(
                'users',
                \App\Models\User::select('id', 'name')->get()
            );
        });

        View::composer(['admin.rates.create', 'rates.edit'], function ($view) {
            return $view->with(
                'senders',
                \App\Models\User::select('id', 'name')->get()
            );
        });

        View::composer(['points.create', 'points.edit'], function ($view) {
            return $view->with(
                'standers',
                \App\Models\Stander::select('id', 'name')->get()
            );
        });

        View::composer(['points.create', 'points.edit'], function ($view) {
            return $view->with(
                'rates',
                \App\Models\Rate::select('id', 'user_id')->get()
            );
        });

        View::composer(['comments.create', 'comments.edit'], function ($view) {
            return $view->with(
                'users',
                \App\Models\User::select('id', 'name')->get()
            );
        });

        View::composer(['comments.create', 'comments.edit'], function ($view) {
            return $view->with(
                'rates',
                \App\Models\Rate::select('id', 'user_id')->get()
            );
        });
    }
}
