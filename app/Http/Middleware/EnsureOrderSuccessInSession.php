<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureOrderSuccessInSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $orderId = $request->route('order_id');
        $sessionOrderId = session('success_order_id');

        if (!$sessionOrderId || $sessionOrderId !== $orderId) {
            abort(403, 'Unauthorized access to success page.');
        }

        return $next($request);
    }
}
