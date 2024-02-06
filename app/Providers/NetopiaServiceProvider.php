<?php

namespace App\Providers;

use App\Contracts\PaymentService;
use App\Events\PaymentStatusChangedEvent;
use App\Listeners\{SavePaymentMethodListener, UpdateBillableTokenOnPayment};
use App\Services\DefaultPaymentService;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class NetopiaServiceProvider extends ServiceProvider
{
    public function register(): void 
    {
        $this->app->bind(PaymentService::class, DefaultPaymentService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        // Register event listeners
        Event::listen(
            PaymentStatusChangedEvent::class,
            [SavePaymentMethodListener::class, 'handle']
        );
        Event::listen(
            PaymentStatusChangedEvent::class,
            [UpdateBillableTokenOnPayment::class, 'handle']
        );
    }
}
