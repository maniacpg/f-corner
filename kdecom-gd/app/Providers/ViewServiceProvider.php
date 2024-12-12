<?php

namespace App\Providers;

use App\Models\Invoice;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $newOrdersCount = Invoice::where('status', 'Đã đặt')->count();
            $view->with('newOrdersCount', $newOrdersCount);
        });
    }
}
