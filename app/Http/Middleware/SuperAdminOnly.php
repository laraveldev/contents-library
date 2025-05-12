<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SuperAdminOnly
{
    public function handle(Request $request, Closure $next): Response
    {
        // Faqat id=1 bo'lsa ruxsat beriladi
        if (auth()->check() && auth()->user()->id == 1) {
            return $next($request);
        }

        // abort(403, 'Bu sahifaga faqat Super Admin kirishi mumkin.');
        return redirect()->route('contents')->with('error', 'Sizda bu sahifaga kirish huquqi yo‘q.');
    }
}
