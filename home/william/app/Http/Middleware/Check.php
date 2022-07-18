<?php

namespace App\Http\Middleware;

use App\Services\SecurityService;
use Closure;
use DateTimeImmutable;
use Illuminate\Http\Request;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\UnencryptedToken;

class Check
{
    private SecurityService $securityService;

    public function __construct(SecurityService $securityService)
    {
        $this->securityService = $securityService;
    }

    public function handle(Request $request, Closure $next)
    {
        $request->validate(['token' => 'required']);

        if(!$this->securityService->checkToken($request)) {
            return response()->json(['error' => 'Token expired'], 401);
        }
        return $next($request);
    }
}
