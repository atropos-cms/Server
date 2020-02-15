<?php

namespace App\Exceptions;

use Closure;
use GraphQL\Error\Error;
use Nuwave\Lighthouse\Execution\ErrorHandler;

class LoginErrorHandler implements ErrorHandler
{
    /**
     * Handle Exceptions that implement Nuwave\Lighthouse\Exceptions\RendersErrorsExtensions
     * and add extra content from them to the 'extensions' key of the Error that is rendered
     * to the User.
     *
     * @param  \GraphQL\Error\Error  $error
     * @param  \Closure  $next
     *
     * @return array
     */
    public static function handle(Error $error, Closure $next): array
    {
        if ($error->getPath() === ['login']) {
            $error = new Error(
                'The given data was invalid.',
                $error->nodes,
                $error->getSource(),
                $error->getPositions(),
                $error->getPath(),
            );
        }

        return $next($error);
    }
}
