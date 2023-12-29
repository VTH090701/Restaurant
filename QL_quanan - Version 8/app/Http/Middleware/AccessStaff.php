<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


class AccessStaff
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //if(Auth::user()->hasRole('admin'))
        if(Auth::user()->hasAnyRoles(['admin','nhanvien_pv','nhanvien_bep']))
        {
   
            return $next($request);
        }

        return redirect('/dashboard');
    }
}
