<?php

namespace App\Providers;

use App\Services\FuelService;
use App\Services\InsuranceService;
use App\Services\ServiceService;
use App\Services\VehicleService;
use Illuminate\Http\Request;
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
        $this->app->bind(VehicleService::class, function (){
            return new VehicleService(new FuelService(), new InsuranceService(), new ServiceService());
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
