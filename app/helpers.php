<?php

use App\Helpers\RoleHelper;

if (! function_exists('role_name')) {
    function role_name($roleId): string {
        return RoleHelper::get((int)$roleId);
    }
}