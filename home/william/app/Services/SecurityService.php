<?php
namespace App\Services;

use DateTimeImmutable;
use Illuminate\Http\Request;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\UnencryptedToken;

class SecurityService
{
    public function checkToken(Request $request)
    {
        $request->validate(['token' => 'required']);

        $config = $this->privateKey();
        $token = $request->token;
        $token = $config->parser()->parse($token);
        assert($token instanceof UnencryptedToken);
        $now = new DateTimeImmutable();

        if ($token->claims()->get('exp') > $now) {
            $request['info'] = $this->extract_info($request);
            //dd($request['info']);
            return true;
        }
        return false;
    }
    public function privateKey()
    {
        $config = Configuration::forSymmetricSigner(
            new Sha256(),
            InMemory::base64Encoded('mBC5v1sOKVvbdEitdSBenu59nfNfhwkedkJVNabosTw=')
        // You may also override the JOSE encoder/decoder if needed by providing extra arguments here
        );
        return $config;
    }
    public function createPublicToken($user)
    {
        $config = $this->privateKey();
        $now = new DateTimeImmutable();
        $token = $config->builder()
            ->issuedAt($now)
            ->expiresAt($now->modify('1 hour'))
            ->withClaim('user_id', $user["id"])
            ->withClaim('user_name', $user["name"])
            ->withClaim('user_email', $user["email"])
            ->getToken($config->signer(), $config->signingKey());
        $token = $token->toString();
        return response()->json(['token' => $token]);
    }
    public function extract_info($token)
    {
        $config = $this->privateKey();
        $token = $config->parser()->parse($token->token);
        assert($token instanceof UnencryptedToken);
        $user = [
            'id' => $token->claims()->get('user_id'),
            'name' => $token->claims()->get('user_name'),
            'email' => $token->claims()->get('user_email')
        ];
        return $user;
    }
}
