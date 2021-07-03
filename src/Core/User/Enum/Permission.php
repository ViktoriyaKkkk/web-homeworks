<?php

declare(strict_types=1);

namespace App\Core\User\Enum;

use App\Core\Common\Enum\AbstractEnum;

class Permission extends AbstractEnum
{
    public const RECIPES_CONTACT_CREATE = 'ROLE_RECIPES_CONTACT_CREATE';
    public const RECIPES_SHOW           = 'ROLE_RECIPES_SHOW';
    public const RECIPES_INDEX          = 'ROLE_RECIPES_INDEX';
    public const RECIPES_CREATE         = 'ROLE_RECIPES_CREATE';
    public const RECIPES_UPDATE         = 'ROLE_RECIPES_UPDATE';
    public const RECIPES_DELETE         = 'ROLE_RECIPES_DELETE';
    public const RECIPES_VALIDATION     = 'ROLE_RECIPES_VALIDATION';
}
