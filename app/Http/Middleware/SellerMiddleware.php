<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SellerMiddleware
{
    public function handle($request, Closure $next)
    {
        Log::info('Log request user1 to location.SellerMiddleware: ', ['request' => $request]);

        $user = auth()->user();
        Log::info('Log user to location.SellerMiddleware: ', ['user' => $user]);

        // ดึงข้อมูล seller ที่เชื่อมโยงกับ user ที่ล็อกอิน
        $seller = $user->seller;

        if ($seller) {
            $seller_id = $seller->id;
            Log::info('Logged in user seller_id: ' . $seller_id);
        }

        return $next($request);

        // Log::info('Log request user2 to location.SellerMiddleware: ', ['request' => $request]);

        // $employee = auth()->employee();
        // // Log::info('Log employee to location.SellerMiddleware: ', $employee);
        // Log::info('Log employee to location.SellerMiddleware: ', ['employee' => $employee]);

        // // ดึงข้อมูล seller ที่เชื่อมโยงกับ user ที่ล็อกอิน
        // $seller = $employee->seller;

        // if ($seller) {
        //     $seller_id = $seller->id;
        //     Log::info('Logged in user employee  seller_id: ' . $seller_id);
        // }

        // return $next($request);
    }
}
