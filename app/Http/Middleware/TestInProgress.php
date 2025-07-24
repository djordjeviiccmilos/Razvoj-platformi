<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class TestInProgress
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if(session('test_in_progress', false)) {
            if(!$request->is('student/test/submit') || !$request->is('student/test/results')) {
                return redirect()->route('student.test.start')->with('warning', 'Morate prvo završiti test!');
            }
        }

        return $next($request);
    }
}
