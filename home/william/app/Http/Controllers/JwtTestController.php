<?php

namespace App\Http\Controllers;

use App\Models\CreateUser;
use Illuminate\Http\Request;
use Lcobucci\JWT\Configuration;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
use DateTimeImmutable;
use Lcobucci\JWT\UnencryptedToken;
use Lcobucci\JWT\Validation\RequiredConstraintsViolated;


//use App\Http\Middleware\TimeConstraint;


class JwtTestController extends Controller
{

    public function index()
    {
        $key = InMemory::plainText('secret');
        dd('jwt_test');
    }

    public function createUser(Request $req)
    {
        $req->validate([
            'name'=> 'string|required',
            'email'=> 'string|required|email',
            'password'=> 'string|required',
        ]);
        $user = new CreateUser();
        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = sha1($req->password);
        $user->save();

        $send = CreateUser::where('name', $req->name)->first();
        $send = [
            'id' => $send->id,
            'name' => $send->name,
            'email' => $send->email,
        ];

        //dd($send);

        $result = $this->createPublicToken($send);

        return response()->json([$result->original]);
    }

    protected function privateKey() {
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

    public function checkToken(Request $request)
    {
        $request->validate(['token']);

        $config = $this->privateKey();
        $token = $request->token;
        $token = $config->parser()->parse($token);
        assert($token instanceof UnencryptedToken);
        //dd($token->claims());
        $verify = [
            'id' => $token->claims()->get('user_id'),
            'name' => $token->claims()->get('user_name'),
            'email' => $token->claims()->get('user_email'),
            'iat' => $token->claims()->get('iat'),
            'exp' => $token->claims()->get('exp')
        ];
        //dd($verify);
        $user = User::find($verify['id']);
        $now = new DateTimeImmutable();
        if ($user) {
            if ($verify["iat"] > $now && $verify["exp"] < $now) {
                return response()->json([$verify["id"], $verify["name"], $verify["email"]]);
            } else {
                return response()->json(['error' => 'Token expired']);
            }
        } else {
            return response()->json(['error' => 'Token invalid'], 404);
        }
    }

    public function checkTokentest(Request $request)
    {
        $config = $this->privateKey();
        $token = $request->token;
        $token = $config->parser()->parse($token);
        assert($token instanceof UnencryptedToken);
        $constraints = $config->validationConstraints();
        $constraints->validate($token);
        //$constraints->TimeConstraint->validate($token);
        try {
            $config->validator()->assert($token, ...$constraints);
            $verify = [
                'id' => $token->claims()->get('user_id'),
                'name' => $token->claims()->get('user_name'),
                'email' => $token->claims()->get('user_email')
            ];
            return response ()->json(['message' => 'token is valid', 'data' => $verify]);
        } catch (RequiredConstraintsViolated $e) {
            return response ()->json(['error' => $e->violations()]);
        }
    }

    public function loginUser(Request $req) {
        $req->validate([
            'email'=> 'string|required',
            'password'=> 'string|required',
        ]);
        $user = CreateUser::where('email', $req->email)->first();
        if ($user) {
            if ($user->password == sha1($req->password)) {
                $send = [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                ];
                $result = $this->createPublicToken($send);
                return response()->json([$result->original]);
            } else {
                return response()->json(['error' => 'Password invalid']);
            }
        } else {
            return response()->json(['error' => 'Email invalid']);
        }
    }

}
