<?php

namespace App\Providers;

use App\Billing\BankPaymentGateway;
use App\Billing\CreditPaymentGateway;
use App\Billing\PaymentGatewayContract;
use App\Channel;
use App\Http\View\Composers\ChannelsComposer;
use Illuminate\Support\Facades\View;
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
        $this->app->singleton(PaymentGatewayContract::class, function($app){

            if(request()->has('credit')){
                return new CreditPaymentGateway('usd');
            }

            return new BankPaymentGateway('usd');
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //option1 : Every single view
        // view()->share('channels', Channel::all());

        //option2  Granular views with wildcards
        // view()->composer(['post.*', 'channel.index'], function ($view) {
        //     $view->with('channels', Channel::all());
        // });

        //option3 dedicated class
        view()->composer(['partials.channels.*'], ChannelsComposer::class);
    }
}
