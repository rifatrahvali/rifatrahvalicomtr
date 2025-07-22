<?php

namespace App\Policies;

use App\Models\Experience;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ExperiencePolicy
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
    public function view(User $user, Experience $experience): bool
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
     * Belirtilen iş deneyimini kullanıcının güncelleyip güncelleyemeyeceğini belirler.
     */
    public function update(User $user, Experience $experience): bool
    {
        // Eğer deneyimi oluşturan kullanıcı ile mevcut kullanıcı aynı ise, güncellemeye izin ver.
        return $user->id === $experience->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    /**
     * Belirtilen iş deneyimini kullanıcının silip silemeyeceğini belirler.
     */
    public function delete(User $user, Experience $experience): bool
    {
        // Eğer deneyimi oluşturan kullanıcı ile mevcut kullanıcı aynı ise, silmeye izin ver.
        return $user->id === $experience->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Experience $experience): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Experience $experience): bool
    {
        return false;
    }
}
