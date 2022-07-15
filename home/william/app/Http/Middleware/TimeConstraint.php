<?php

namespace App\Http\Middleware;

use Lcobucci\JWT\Token;
use Lcobucci\JWT\Validation\ConstraintViolation;
use Lcobucci\JWT\Validation\RequiredConstraintsViolated;
use DateTimeImmutable;

/*final class TimeConstraint implements Constraint
{
    public function validate(Token $token): void
    {
        $now = new DateTimeImmutable();
        $iat = $token->claims()->get('iat');
        $exp = $token->claims()->get('exp');
        if ($iat > $now || $exp < $now) {
            throw new RequiredConstraintsViolated(
                'The token is expired or not yet valid',
                [
                    new ConstraintViolation(
                        'The token is expired or not yet valid',
                        'iat',
                        $iat,
                        $now
                    ),
                    new ConstraintViolation(
                        'The token is expired or not yet valid',
                        'exp',
                        $exp,
                        $now
                    )
                ]
            );
        }
    }
}
