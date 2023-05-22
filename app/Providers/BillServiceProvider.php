<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use App\Service\BillService;

class BillServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('billService', function ($app) {
            return new BillService();
        });
    }
}

