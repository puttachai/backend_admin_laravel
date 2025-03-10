<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Log;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    
    public function handle($request, \Closure $next, ...$guards)
    {
        Log::info('Log => guard to Location.Authenticate:', ['guard' => $guards]);
        // Log::info('Log => request to Location.Authenticate:', ['request' => $request]);
        // กำหนดค่า guard หากไม่มีการระบุ guard
        $guards = empty($guards) ? ['web'] : $guards;

        // ตรวจสอบการยืนยันตัวตนตาม guard
        $this->authenticate($request, $guards);

        return $next($request);
    }

}
