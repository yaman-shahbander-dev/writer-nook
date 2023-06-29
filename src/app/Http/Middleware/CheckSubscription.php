<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $subscription = $request->user()->subscriptions()->where('stripe_status', 'active')->first();
        if ($subscription) {
            return $next($request);
        }

        return redirect()->route('user.plan.index');
    }
}
