<?php

namespace App\Providers;

use App\Excom;
use App\Member;
use App\Settings;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
        $basic_settings = Settings::all();
        unset($settings);
        $settings = array();
        foreach ($basic_settings as $bSet) {
            $settings[$bSet['settings_key']] = $bSet['settings_value'];
        }
        View::share(['settings'=> $settings]);

        /*
        view()->composer('layouts.frontend', function ($view) {
                    $basic_settings = Settings::all();
                    unset($settings);
                    $settings = array();
                    foreach ($basic_settings as $bSet){
                        $settings[$bSet['settings_key']] = $bSet['settings_value'];
                    }
                    $view->with('settings', $settings);
                });
               */
    }
}
