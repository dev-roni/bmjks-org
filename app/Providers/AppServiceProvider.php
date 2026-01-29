<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use App\Models\Setting;
use App\Models\CommitteeName;
use Illuminate\Pagination\Paginator;

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
        Blade::directive('bn', function ($expression) {
            return "<?php 
                echo str_replace(
                    ['0','1','2','3','4','5','6','7','8','9','/','.','-'],
                    ['০','১','২','৩','৪','৫','৬','৭','৮','৯','/','.','-'],
                    $expression
                ); 
            ?>";
        });

        Blade::directive('member_count', function ($expression) {
            return "<?php 
                \$count = \\App\\Models\\PersonType::where('status', 'active')
                    ->where('id', {$expression})
                    ->withCount(['people as count' => function(\$query) {
                        \$query->where('member_aproved', '!=', 'no');
                    }])
                    ->value('count') ?? 0;

                echo str_replace(
                    ['0','1','2','3','4','5','6','7','8','9'],
                    ['০','১','২','৩','৪','৫','৬','৭','৮','৯'],
                    \$count
                );
            ?>";
        });




        View::composer('*', function ($view) {
            $view->with('setting', Setting::first());
        });

        View::composer('*', function ($view) {
            $view->with('committeeNames', CommitteeName::get());
        });

        Blade::if('superadmin', function () {
            return Auth::check() && Auth::user()->account_type === 'superadmin';
        });

        Blade::if('admin', function () {
            return Auth::check() && Auth::user()->account_type === 'admin';
        });

        Blade::if('cashier', function () {
            return Auth::check() && Auth::user()->account_type === 'cashier';
        });


        Paginator::useBootstrapFive();
    }

}