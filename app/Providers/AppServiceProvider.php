<?php

namespace App\Providers;

use App\Models\Contact;
use App\Models\Language;
use Illuminate\Http\Resources\Json\JsonResource;
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
    public function boot()
    {
        view()->composer('components.header', function ($view) {
            $view->with('current_locale', app()->getLocale());
            $view->with('available_locales', Language::all());
        });
        view()->composer('components.navbar', function ($view) {
            $view->with('notifications_count', count(Contact::where('read_at', null)->get()));
        });

        JsonResource::withoutWrapping();
    }
}
