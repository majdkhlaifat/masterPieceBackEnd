<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client;

class CaloriesBurnedServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */

    public function register()
    {
        $this->app->singleton('calories-burned-api', function ($app) {
            return new Client([
                'base_uri' => 'https://calories-burned-by-api-ninjas.p.rapidapi.com/v1/',
                'headers' => [
                    'X-Rapidapi-Key' => '6101480189msh20198f88d93fd20p162f05jsn5e19bfee5131',
                    'X-Rapidapi-Host' => 'calories-burned-by-api-ninjas.p.rapidapi.com',
                ],
            ]);
        });
    }


    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }

    
}
