<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use App\Models\Setting;
use App\View\Components\FlashMessages;

class AppServiceProvider extends ServiceProvider
{
    
    use FlashMessages;
    
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
        Paginator::useBootstrap();
        view()->composer('*', function ($view) {
            $setting = Setting::first();
            $homeNotyFy = '';
            return $view->with(['setting'=> $setting, 'homeNotify' => $homeNotyFy]);
        });

        view()->composer('components.flash-messages', function ($view) {
            $messages = self::messages();
            return $view->with('messages', $messages);
        });
    }
}
