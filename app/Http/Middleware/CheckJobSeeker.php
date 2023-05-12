<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
class CheckJobSeeker{
    public function handle(Request $request, Closure $next):Response{
        if(Auth::user() && Auth::user()->status == 'jobseeker'){
            return $next($request);
        }
        return redirect()->route('login');
    }
}