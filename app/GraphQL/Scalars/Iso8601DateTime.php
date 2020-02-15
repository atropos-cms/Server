<?php

namespace App\GraphQL\Scalars;

use Carbon\Carbon;
use GraphQL\Utils\Utils;
use GraphQL\Error\InvariantViolation;

class Iso8601DateTime extends \Nuwave\Lighthouse\Schema\Types\Scalars\DateTime
{
    /**
     * Serialize an internal value, ensuring it is a valid datetime string.
     *
     * @param  \Carbon\Carbon|string  $value
     *
     * @return string
     */
    public function serialize($value): string
    {
        if ($value instanceof Carbon) {
            return $value->toIso8601String();
        }

        return $this
            ->tryParsingDateTime($value, InvariantViolation::class)
            ->toIso8601String();
    }

    /**
     * Try to parse the given value into a Carbon instance, throw if it does not work.
     *
     * @param  mixed  $value
     * @param  string  $exceptionClass
     *
     * @throws \GraphQL\Error\InvariantViolation|\GraphQL\Error\Error
     *
     * @return \Carbon\Carbon
     */
    protected function tryParsingDateTime($value, string $exceptionClass): Carbon
    {
        try {
            return Carbon::createFromFormat(Carbon::ISO8601, $value);
        } catch (\Exception $e) {
            throw new $exceptionClass(
                Utils::printSafeJson(
                    $e->getMessage()
                )
            );
        }
    }
}
