<?php

namespace App\Http\Middleware;

use Closure;
use DB;

class CheckSettings
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
        $settings = DB::table('site_settings')->first();

        if (!$settings) {

            if ($request->user() && $request->user()->is_admin) {
                return redirect()->action('SettingController@index');
            }
            else {
                return redirect()->action('SettingController@not_configured');
            }

        }

        return $next($request);

    }
}
