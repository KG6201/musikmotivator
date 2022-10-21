<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category; //  追加
use Illuminate\Support\Facades\Schema; //  追加

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

    /*
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
    }
}
