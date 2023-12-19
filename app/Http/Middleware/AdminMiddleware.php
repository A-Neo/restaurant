<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdminMiddleware
{
    /**
     * Обрабатывает входящий запрос.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Проверка, что пользователь аутентифицирован
        if (!Auth::check()) {
            abort(403, 'Доступ запрещен.');
        }
        Log::info('Auth: ', ['Auth::user: ' => Auth::user()]);
        Log::info('if !Auth::check: ', ['Auth::check: ' => Auth::check()]);
        // Проверка на административные права пользователя
        if (!Auth::user()->isAdmin()) {
            Log::info('Auth-User: ', ['Auth::user(): ' => Auth::user()]);
            Log::info('if !Auth::user()->isAdmin: ', ['Auth::user()->isAdmin: ' => Auth::user()->isAdmin()]);
            abort(403, 'Недостаточно прав для доступа.');
        }
        Log::info('Auth-User: ', ['Auth::user(): ' => Auth::user()]);
        Log::info('if !Auth::user()->isAdmin: ', ['Auth::user()->isAdmin: ' => Auth::user()->isAdmin()]);
        return $next($request);
    }
}
