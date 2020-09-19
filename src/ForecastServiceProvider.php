<?php

namespace Krepysh\Forecast;

use Illuminate\Support\ServiceProvider;

/**
 * Class ForecastServiceProvider
 *
 * @package Krepysh\Forecast
 */
class ForecastServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->_publishConfig();
    }

    /**
     * Publish config file
     */
    private function _publishConfig(): void
    {
        $path = $this->_getConfigPath();
        $this->publishes([$path => config_path('forecast.php')], 'config');
    }

    /**
     * Get config path
     *
     * @return string
     */
    private function _getConfigPath(): string
    {
        return __DIR__ . '/config/forecast.php';
    }
}
