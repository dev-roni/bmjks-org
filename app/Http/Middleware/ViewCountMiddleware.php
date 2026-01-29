<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;
use App\Jobs\ViewCountJob;


class ViewCountMiddleware
{
    public function handle($request, Closure $next)
    {   
        if (!session()->has('view_counted')) {

            $view = ViewCount::first();

            if ($view) {
                $view->increment('count');
            } else {
                ViewCount::create(['count' => 1]);
            }

            session(['view_counted' => true]);
            Session::put('view_counted_time', now());
            
        }

        return $next($request);
    }
}
