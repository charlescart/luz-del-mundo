<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;

class Language
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!empty(session('lang', config('app.locale')))) {
            \App::setLocale(session('lang', config('app.locale')));
            Carbon::setLocale(session('lang', config('app.locale')));
        }
        return $next($request);
    }
}
