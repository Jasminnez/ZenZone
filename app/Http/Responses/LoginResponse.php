<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{

    public function toResponse($request)
    {
        // below is the existing response
        // replace this with your own code
        // the user can be located with Auth facade
        if(auth()->user()->role_id=='1')
        $home =  '/dashboard';
        else if(auth()->user()->role_id=='2')
        $home =  '/daily-challenges';
        else if(auth()->user()->role_id=='3')
            return abort(403);
        return redirect()->intended($home);
    }

}