<?php

namespace Avl\Logger;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;

class AvlLoggerServiceProvider extends ServiceProvider
{

    protected $observers = [];

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
      $this->publishes([
          __DIR__ . '/../config/avllogger.php' => config_path('avllogger.php'),
      ]);

      $this->loadViewsFrom(__DIR__ . '/../resources/views', 'avl-logger');

      $this->loadRoutesFrom(__DIR__ . '/routes.php');

      if (count($this->observers) > 0) {
        if (\Request::is([ 'admin', 'admin/*' ])) {
          foreach ($this->observers as $model => $observer) {
            if (class_exists($model) && class_exists($observer)) {
              $model::observe($observer);
            }
          }
        }
      }

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

        // объединение настроек с опубликованной версией
        $this->mergeConfigFrom(__DIR__.'/../config/avllogger.php', 'avllogger');

        // migrations
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->observers = config('avllogger.observers') ?? [];

        $this->loadHelpers();

    }

    /**
     * Load helpers.
     */
    protected function loadHelpers()
    {
        foreach (glob(__DIR__ . '/Helpers/*.php') as $filename) {
            require_once $filename;
        }
    }
}
