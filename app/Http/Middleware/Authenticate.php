<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

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
            // กรณีผู้ใช้เป็น admin (guard admin)
            if ($request->is('admin') || $request->is('admin/*')) {
                return route('admin.login');  // ชื่อ route admin.login ที่เราสร้างไว้
            }

            // กรณีผู้ใช้ทั่วไป
            return route('login');  // กรณีมีระบบ login users ปกติ (ถ้ามี)
        }
    }
}
