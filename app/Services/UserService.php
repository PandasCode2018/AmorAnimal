<?php

namespace App\Services;

use App\Models\User;
use Spatie\Permission\Models\Role;

/**
 * Servicio para manejar los roles.
 */
class UserService
{
    /**
     * Actualiza los permisos de un rol y los sincroniza con los usuarios que tienen este rol.
     *
     * @param  Role  $role  El rol a actualizar.
     * @param  array  $rolePermissions  Los nuevos permisos para el rol.
     */
    public static function rolesChanged(User $user, array $roles): void
    {
        $user->syncRoles($roles);
        $user->refresh();
        $permissions = [];
        foreach ($roles as $roleName) {
            $role = Role::findByName($roleName);
            $permissions = array_unique(array_merge($permissions, $role->permissions->pluck('name')->toArray()));
        }
        $user->syncPermissions($permissions);
    }
}
