<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CanAccessThanksPage
{
    public function handle(Request $request, Closure $next)
    {
        if(!session()->has('order')){
            return redirect()->route('home');
        }

        return $next($request);
    }
}
