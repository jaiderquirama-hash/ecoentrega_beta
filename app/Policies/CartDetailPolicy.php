<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\CartDetail;
use Illuminate\Auth\Access\HandlesAuthorization;

class CartDetailPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:CartDetail');
    }

    public function view(AuthUser $authUser, CartDetail $cartDetail): bool
    {
        return $authUser->can('View:CartDetail');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:CartDetail');
    }

    public function update(AuthUser $authUser, CartDetail $cartDetail): bool
    {
        return $authUser->can('Update:CartDetail');
    }

    public function delete(AuthUser $authUser, CartDetail $cartDetail): bool
    {
        return $authUser->can('Delete:CartDetail');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:CartDetail');
    }

    public function restore(AuthUser $authUser, CartDetail $cartDetail): bool
    {
        return $authUser->can('Restore:CartDetail');
    }

    public function forceDelete(AuthUser $authUser, CartDetail $cartDetail): bool
    {
        return $authUser->can('ForceDelete:CartDetail');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:CartDetail');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:CartDetail');
    }

    public function replicate(AuthUser $authUser, CartDetail $cartDetail): bool
    {
        return $authUser->can('Replicate:CartDetail');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:CartDetail');
    }

}