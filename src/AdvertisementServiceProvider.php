<?php


namespace Aoeng\Laravel\Admin\Advertisement;


use Illuminate\Support\ServiceProvider;

class AdvertisementServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if (!Advertisement::boot()) {
            return;
        }

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
    }

}
