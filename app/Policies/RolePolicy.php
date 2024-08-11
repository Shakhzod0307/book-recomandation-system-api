<?php

namespace App\Policies;

use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class RolePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Role $role): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(): bool
    {
        return auth()->user()->role->name === 'superadmin'||auth()->user()->role->name === 'admin' ;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Role $role): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(): bool
    {
        return auth()->user()->role->name === 'superadmin';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Role $role): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Role $role): bool
    {
        //
    }
}
