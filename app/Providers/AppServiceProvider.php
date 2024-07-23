<?php

namespace App\Providers;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        $this->registerFilePolicy();
    }

    /**
     * Register the File model's policy.
     *
     * @return void
     */
    public function registerFilePolicy()
    {
        Gate::policy(File::class, FilePolicy::class);
    }
}