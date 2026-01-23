<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $allowed_list = array_slice(func_get_args(), 2);

        if (Auth::check()) {
            $user = Auth::user();

            // --- ตรวจสอบ Status Pending ---
            if ($user->status == 'Pending') {
                // ป้องกัน Infinite Loop: ถ้ากำลังจะไปหน้า pending_status อยู่แล้ว ให้ผ่านไปได้เลย
                if ($request->is('pending_status')) {
                    return $next($request);
                }
                
                // ถ้าพยายามไปหน้าอื่น ให้กลับมาที่ pending_status
                return redirect('/pending_status');
            }
            // ----------------------------------------

            // เช็ค Role
            $role = $user->role;
            
            // ถ้า Role อยู่ใน list ที่อนุญาต
            if (in_array($role, $allowed_list, true)) {
                return $next($request);
            }
        }

        // ถ้าไม่ได้ Login หรือ Role ไม่ผ่าน ให้ไปหน้า home
        return redirect('/home');
    }
}
