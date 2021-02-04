<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Inertia\Inertia;
use Config;

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
    public function boot()
    {
        Schema::defaultStringLength(191);

        // Multiple values
        Inertia::share([
            // Synchronously
            'app' => [
                'name' => Config::get('app.name')
            ],
            // 执行完数据迁移再打开这个
            'common'=>function(){
                return CacheServiceProvider::getBaseData();
            },
        ]);
    }
}
