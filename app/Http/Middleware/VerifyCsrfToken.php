<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        //
        // 'https://high-voltage-9884-backend.zendev.se/api/login',
        // 'https://high-voltage-9884-backend.zendev.se/api/register',
        // 'https://high-voltage-9884-backend.zendev.se/api/logout',
        // 'https://high-voltage-9884-backend.zendev.se/api/user-activities',
        'https://high-voltage-9884-backend.zendev.se/api/*',
    ];
}
