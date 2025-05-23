<?php

namespace App\Policies;

use App\Models\Documentation;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DocumentationPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyRole(['admin', 'chief', 'physio', 'intern']);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Documentation $documentation): bool
    {
        return $user->hasAnyRole(['admin', 'chief', 'physio', 'intern']);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Documentation $documentation): bool
    {
        return $user->hasAnyRole(['chief', 'physio']);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Documentation $documentation): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Documentation $documentation): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Documentation $documentation): bool
    {
        //
    }
}
