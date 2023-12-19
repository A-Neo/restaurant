<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class NormalizeURL
{
    public function handle(Request $request, Closure $next)
    {
        Log::info('handle', ['$request: ' => $request->all()]);
        Log::info('handle2', ['$request->getRequestUri(): ' => $request->getRequestUri()]);
        $originalUrl = $request->getRequestUri();
        $normalizedUrl = $this->normalizeUrl($originalUrl);
        Log::info('handle3', ['$normalizedUrl: ' => $normalizedUrl]);

        if ($originalUrl !== $normalizedUrl) {
            Log::info('handle4', ['$normalizedUrl: '=> $normalizedUrl, '$originalUrl: ' => $originalUrl]);

            return redirect($normalizedUrl, 301);
        }

        return $next($request);
    }

    private function normalizeUrl(string $url): string
    {
        // Удаление 'index.php'
        $url = Str::replaceFirst('index.php', '', $url);

        // Удаление повторяющихся слешей
        $url = preg_replace('/(https?:\/\/)|(\/{2,})/', '$1/', $url);

        // Удаление пустых параметров запроса
        $url = preg_replace('/\?$/', '', $url);

        return $url;
    }
}
