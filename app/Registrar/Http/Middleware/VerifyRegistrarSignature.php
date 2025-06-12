<?php
namespace App\Registrar\Http\Middleware;

use Closure;
use Illuminate\Support\Str;
use App\Registrar\Models\RegistrarApiKey;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class VerifyRegistrarSignature
{
    public function handle($request, Closure $next)
    {
        $keyValue = $request->header('X-Registrar-Key');
        $signature = $request->header('X-Registrar-Signature');
        $timestamp = $request->header('X-Registrar-Timestamp');

        if (!$keyValue || !$signature || !$timestamp) {
            throw new UnauthorizedHttpException('', 'Missing authentication headers');
        }

        $key = RegistrarApiKey::where('key',$keyValue)->where('is_active',true)->first();
        if (!$key) {
            throw new UnauthorizedHttpException('', 'Invalid key');
        }

        $computed = hash_hmac('sha256', $timestamp . $request->getContent(), $key->secret);
        if (!hash_equals($computed, $signature)) {
            throw new UnauthorizedHttpException('', 'Signature mismatch');
        }

        app()->instance('registrar', $key->registrar);

        return $next($request);
    }
}
