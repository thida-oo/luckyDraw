<?php

namespace App\Providers;

use dingTalkProvider;
use Illuminate\Support\ServiceProvider;
use Laravel\Socialite\Contracts\Factory;
use Laravel\Socialite\SocialiteManager;
use SocialiteDing;
use Laravel\Socialite\SocialiteServiceProvider as SocialiteParentServiceProvider;
use Socialite;

class SocialiteServiceProvider extends SocialiteParentServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind('Laravel\Socialite\Contracts\Factory', function ($app) {
            $socialiteManager = new SocialiteManager($app);

            $socialiteManager->extend('dingtalk', function() use ($socialiteManager) {
                $config = $this->app['config']['services.dingtalk'];

                return $socialiteManager->buildProvider(
                    'App\Socialite\dingTalkProvider', $config
                );
            });
            return $socialiteManager;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    /**
 * @throws  BindingResolutionException
 */
    public function boot()
    {
        //
    }
}
