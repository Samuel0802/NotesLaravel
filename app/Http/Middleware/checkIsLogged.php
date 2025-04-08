<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class checkIsLogged
{

    public function handle(Request $request, Closure $next): Response
    {
        //check If user Logged
        if(!session('user')){
            return redirect('/login');
        }

        return $next($request);
    }
}
