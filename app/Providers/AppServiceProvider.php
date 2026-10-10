<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Label;
use App\Models\Ticket;
use App\Models\User;
use App\Observers\CategoryObserver;
use App\Observers\LabelObserver;
use App\Observers\TicketObserver;
use App\Observers\UserObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
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
            Schema::defaultStringLength(191);
            Paginator::useBootstrapFive();
            Ticket::observe(TicketObserver::class);
            User::observe(UserObserver::class);
            Label::observe(LabelObserver::class);
            Category::observe(CategoryObserver::class);
    }
}
