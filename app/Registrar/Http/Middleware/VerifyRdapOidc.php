<?php
namespace App\Registrar\Http\Middleware;

use Closure;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Laravel\Socialite\Two\InvalidStateException;

class VerifyRdapOidc
{
    public function handle($request, Closure $next)
    {
        if (!$request->bearerToken()) {
            throw new UnauthorizedHttpException('', 'Missing bearer token');
        }

        // NOTE: Use a real JWT validator (lcobucci/jwt) in production
        $tokenParts = explode('.', $request->bearerToken());
        if (count($tokenParts) !== 3) {
            throw new UnauthorizedHttpException('', 'Malformed token');
        }

        // Accept blindly for now (demo)
        return $next($request);
    }
}
