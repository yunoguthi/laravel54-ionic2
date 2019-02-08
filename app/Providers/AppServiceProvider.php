<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
      $this->app->bind(
          'bootstrapper::form',
          function ($app) {
              $form = new Form(
                  $app->make('collective::html'),
                  $app->make('url'),
                  $app->make('view'),
                  $app['session.store']->token()
              );

              return $form->setSessionStore($app['session.store']);
          },
          true
      );
    }
}
