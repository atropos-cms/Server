<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static AdministrationRoles()
 * @method static static AdministrationUsers()
 * @method static static AdministrationSettings()
 * @method static static CollaborationFileWorkspaces()
 */
final class Permission extends Enum
{
    const AdministrationRoles = 'administration-roles';
    const AdministrationUsers = 'administration-users';
    const AdministrationSettings = 'administration-settings';

    const CollaborationFileWorkspaces =   'collaboration-files-workspaces';
}
