<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class checkIsNotLogged
{

    public function handle(Request $request, Closure $next): Response
    {
        //check if user not Logged
        if(session('user')){
            return redirect('/');
        }

        return $next($request);
    }
}
