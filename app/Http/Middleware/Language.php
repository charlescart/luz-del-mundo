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
        if (!empty(session('lang', 'es'))) {
            \App::setLocale(session('lang', 'es'));
            Carbon::setLocale(session('lang', 'es'));
        }
        return $next($request);
    }
}
