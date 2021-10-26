<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Role as Middleware;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{

  public function handle($request, Closure $next)
  {
    if (!$request->user()->isAdmin()) {
      abort(403);
    }

    return $next($request);
  }
}
