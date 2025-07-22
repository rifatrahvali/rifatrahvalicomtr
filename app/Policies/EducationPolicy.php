<?php

namespace App\Policies;

use App\Models\Education;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class EducationPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Education $education): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    /**
     * Belirtilen eğitim kaydını kullanıcının güncelleyip güncelleyemeyeceğini belirler.
     * Kullanıcı, sadece kendi eğitim kaydını güncelleyebilir.
     */
    public function update(User $user, Education $education): bool
    {
        // Giriş yapmış kullanıcının ID'si, eğitim kaydının user_id'si ile eşleşiyorsa true döner.
        return $user->id === $education->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    /**
     * Belirtilen eğitim kaydını kullanıcının silip silemeyeceğini belirler.
     * Kullanıcı, sadece kendi eğitim kaydını silebilir.
     */
    public function delete(User $user, Education $education): bool
    {
        // Giriş yapmış kullanıcının ID'si, eğitim kaydının user_id'si ile eşleşiyorsa true döner.
        return $user->id === $education->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Education $education): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Education $education): bool
    {
        return false;
    }
}
