<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Domain
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {


        $path = explode('/' ,$request->url());
        if($path[2] != auth()->user()->domain->domain.'.'.env('DOMAIN')){
            abort(404);
        }
        return $next($request);
    }
}
