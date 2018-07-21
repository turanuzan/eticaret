<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            // KullaniciController içerisinde guest middleware kullanıldı.
            // guest middleware de Kernel.php içerisinde buraya baktığını görmekteyiz.
            // giriş yapıldıktan sonra ulaşılmaması gereken bir sayfaya geldiğinde home sayfasına yönlendiriliyor.
            // bizde home sayfası olmadığı için / olarak değiştiriyoruz.
            return redirect('/');
            //return redirect('/home');
        }

        return $next($request);
    }
}
