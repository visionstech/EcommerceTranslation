<?php namespace App\Http\Middleware;

use Closure;
use Auth;

class RedirectPage {

    public function handle($request, Closure $next)
    {
		if ($this->auth->check()) {
            return redirect('/dashboard');
        }
	}
}