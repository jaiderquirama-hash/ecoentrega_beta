<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\ShoppingCart;
use Illuminate\Auth\Access\HandlesAuthorization;

class ShoppingCartPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:ShoppingCart');
    }

    public function view(AuthUser $authUser, ShoppingCart $shoppingCart): bool
    {
        return $authUser->can('View:ShoppingCart');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:ShoppingCart');
    }

    public function update(AuthUser $authUser, ShoppingCart $shoppingCart): bool
    {
        return $authUser->can('Update:ShoppingCart');
    }

    public function delete(AuthUser $authUser, ShoppingCart $shoppingCart): bool
    {
        return $authUser->can('Delete:ShoppingCart');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:ShoppingCart');
    }

    public function restore(AuthUser $authUser, ShoppingCart $shoppingCart): bool
    {
        return $authUser->can('Restore:ShoppingCart');
    }

    public function forceDelete(AuthUser $authUser, ShoppingCart $shoppingCart): bool
    {
        return $authUser->can('ForceDelete:ShoppingCart');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:ShoppingCart');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:ShoppingCart');
    }

    public function replicate(AuthUser $authUser, ShoppingCart $shoppingCart): bool
    {
        return $authUser->can('Replicate:ShoppingCart');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:ShoppingCart');
    }

}