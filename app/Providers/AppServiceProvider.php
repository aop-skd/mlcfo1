<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\UrlGenerator;//この行を追加
use Illuminate\Pagination\Paginator;//ここ追記

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Paginator::useBootstrapFive();//ここ追記
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    //bootメソッドを以下に変更
    public function boot(UrlGenerator $url)
    {
        $url->forceScheme('https');
    }
}
