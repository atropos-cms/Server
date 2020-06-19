<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Disabled()
 * @method static static Members()
 * @method static static Public()
 */
final class RoleMailingList extends Enum
{
    const Disabled = 0;
    const Members = 1;
    const Registered = 2;
    const Public = 3;
}
