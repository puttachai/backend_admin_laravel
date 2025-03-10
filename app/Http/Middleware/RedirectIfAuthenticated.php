<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        // Log::info('Log request: ', $request);
        // Log::info('Log guard: ', $guard);
        Log::info('Log => guard to Location.RedirectIfAuthenticated:', ['guard' => $guard]);
        // Log::info('Log => request to Location.RedirectIfAuthenticated:', ['request' => $request]);

        if (Auth::guard($guard)->check()) {
            return redirect(RouteServiceProvider::HOME);
        }

        //  // กำหนดค่า guard เป็น employee หากไม่มีการระบุ
        // $guards = empty($guards) ? ['employee'] : $guards;

        // // ตรวจสอบการยืนยันตัวตนด้วย guard ที่กำหนด
        // $this->authenticate($request, $guards);

        return $next($request);
    }
}
