<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Installment;
use Illuminate\Auth\Access\HandlesAuthorization;

class InstallmentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the installment.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Installment  $installment
     * @return mixed
     */
    // public function view(User $user, Installment $installment)
    // {
    //     //
    // }

    /**
     * Determine whether the user can create installments.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    // public function create(User $user)
    // {
    //     //
    // }

    /**
     * Determine whether the user can update the installment.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Installment  $installment
     * @return mixed
     */
    // public function update(User $user, Installment $installment)
    // {
    //     //
    // }

    /**
     * Determine whether the user can delete the installment.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Installment  $installment
     * @return mixed
     */
    // public function delete(User $user, Installment $installment)
    // {
    //     //
    // }

    /**
     * Determine whether the user can restore the installment.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Installment  $installment
     * @return mixed
     */
    // public function restore(User $user, Installment $installment)
    // {
    //     //
    // }

    /**
     * Determine whether the user can permanently delete the installment.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Installment  $installment
     * @return mixed
     */
    // public function forceDelete(User $user, Installment $installment)
    // {
    //     //
    // }

    public function own(User $user, Installment $installment)
    {
        return $installment->user_id == $user->id;
    }
}
