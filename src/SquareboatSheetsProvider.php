<?php

namespace Squareboat\Sheets;

use Illuminate\Support\ServiceProvider;

class SquareboatSheetsProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->publishes([
            dirname(__DIR__, 1).'/config/sheets.php' => config_path('sheets.php'),
        ]);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->mergeConfigFrom(
            dirname(__DIR__, 1).'/config/sheets.php', 'sheets'
        );
    }
}
