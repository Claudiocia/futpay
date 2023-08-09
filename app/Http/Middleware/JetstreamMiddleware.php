<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JetstreamMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $int = count(Auth::user()->plataformas);
        $intGames = count(Auth::user()->games);
        if ($int == 0 || $intGames == 0){
            return redirect()->route('logado.users.edit', ['user' => Auth::user()->id]);
        }
        return $next($request);
    }
}
