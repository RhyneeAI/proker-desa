<?php

namespace App\Http\Middleware;

use App\Models\PageVisit;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisit
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($request->isMethod('GET') && ! $request->is('admin*', 'login', 'logout', 'up', 'sitemap.xml', 'robots.txt', 'build/*', 'hot')) {
            PageVisit::create([
                'ip' => $request->ip(),
                'user_agent' => substr((string) $request->userAgent(), 0, 255),
                'url' => substr($request->path(), 0, 255),
            ]);
        }

        return $response;
    }
}
