<?php

namespace App\Http\Middleware;

use Closure;

class Maintenance
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
      $controller = get_controller_name($request);
      session_time_out();     // flush session every 8 hours
      fetch_wishlist();       // fetch wishlist from database
      // Check if the user visit shop page or shop details page
      if ($controller == 'ShopProductsController') {
        recording_user_daily_visit($controller);        // Store visit Count for Unique User IP
      }

      if (setting()->status == 'close') {
            return redirect('maintenance');
        }
        return $next($request);
    }
}
