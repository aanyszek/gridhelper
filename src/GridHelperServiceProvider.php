<?php

namespace Bunta\gridHelper;

/**
 * 
 * @author 
 */
use Illuminate\Support\ServiceProvider;

class GridHelperServiceProvider extends ServiceProvider {

    public function boot() {
        $this->publishes([
            __DIR__ . '/migrations' => $this->app->databasePath() . '/migrations'
                ], 'migrations');
        $this->publishes([
            __DIR__ . '/config' => config_path()
                ], 'config');
    }

    public function register() {
          $this->mergeConfigFrom(
                __DIR__ . '/config/translations.php', 'translations'
        );
    }

}
