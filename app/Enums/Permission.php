<?php

namespace App\Enums;

enum Permission: string
{
    case ALL_ACCESS = 'all-access';

    case ROLE_VIEW = 'role-view';
    case ROLE_CREATE = 'role-create';
    case ROLE_EDIT = 'role-edit';
    case ROLE_DELETE = 'role-delete';

    case USER_VIEW = 'user-view';
    case USER_CREATE = 'user-create';
    case USER_EDIT = 'user-edit';
    case USER_DELETE = 'user-delete';
}
