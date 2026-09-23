<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\OrderDetail;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderDetailPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:OrderDetail');
    }

    public function view(AuthUser $authUser, OrderDetail $orderDetail): bool
    {
        return $authUser->can('View:OrderDetail');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:OrderDetail');
    }

    public function update(AuthUser $authUser, OrderDetail $orderDetail): bool
    {
        return $authUser->can('Update:OrderDetail');
    }

    public function delete(AuthUser $authUser, OrderDetail $orderDetail): bool
    {
        return $authUser->can('Delete:OrderDetail');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:OrderDetail');
    }

    public function restore(AuthUser $authUser, OrderDetail $orderDetail): bool
    {
        return $authUser->can('Restore:OrderDetail');
    }

    public function forceDelete(AuthUser $authUser, OrderDetail $orderDetail): bool
    {
        return $authUser->can('ForceDelete:OrderDetail');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:OrderDetail');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:OrderDetail');
    }

    public function replicate(AuthUser $authUser, OrderDetail $orderDetail): bool
    {
        return $authUser->can('Replicate:OrderDetail');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:OrderDetail');
    }

}