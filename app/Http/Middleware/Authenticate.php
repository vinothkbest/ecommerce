<?php

namespace App\Http\Middleware;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request, $guards='web')
    {
        if (! $request->expectsJson()) {
            switch ($guards[0]) {
                case 'admin':
                    $route="admin.login";
                    break;
                case 'web':
                    $route="user.form";
                    break;
                break;
            }
            return route($route, ['login']);
        }
    }

    protected function unauthenticated($request, array $guards)
    {
        throw new AuthenticationException(
            'Unauthenticated.',
            $guards,
            $this->redirectTo($request, $guards)
        );
    }
}
