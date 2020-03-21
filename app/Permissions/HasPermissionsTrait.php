<?php
namespace App\Permissions;

use App\models\Role;

trait HasPermissionsTrait {
    public function hasRole(string $role ) {
        $result = collect(get_object_vars($this->roles)['attributes']);
        if ($result->contains($role)) {
            return true;
        }
        return false;
    }

    public function roles() {
        return $this->belongsTo(Role::class);
    }
}
