<?php

namespace App\Enums;

/**
 * @method static static Public()
 * @method static static NotPublic()
 */
final class PublicStatus extends BaseEnum
{
    const Public = 1;
    const NotPublic = 0;
}
