<?php

namespace App\Providers;

use App\Http\Middleware\VerifiedUserMiddleware;
use Illuminate\Auth\Events\Verified;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Authenticate::redirectUsing(function ($request) {
            return route('auth.login');
        });

        Paginator::useTailwind();

        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->subject('Verify Email Address')
                ->line('Please click the button below to verify your email address.')
                ->greeting('Hey !')
                ->action('Verify my email', $url);
        });

        $this->app['router']->aliasMiddleware('verified_user', VerifiedUserMiddleware::class);
    }
}
