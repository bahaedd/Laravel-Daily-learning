<?php

namespace App\Providers;

use App\Billing\BankPaymentGateway;
use App\Billing\CreditPaymentGateway;
use App\Billing\PaymentGatewayContract;
use App\Channel;
use App\Http\View\Composers\ChannelsComposer;
use App\Mixins\StrMixins;
use App\Post;
use App\PostcardSendingService;
use Illuminate\Routing\ResponseFactory;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

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

        //facades

        $this->app->singleton('Postcard', function($app) {
            return new PostcardSendingService('Morocco', 4, 6);
        });

        //macros

        // Str::macro('partNumber', function ($part){
        //     return 'AB-' .substr($part, 0, 3) .'-' .substr($part, 3);
        // });

        Str::mixin(new StrMixins());

        ResponseFactory::macro('errorJson', function($message = 'Default error message') {
            return [
                'message' => $message,
                'error_code'=> 555,
            ];
        });
    }
}
