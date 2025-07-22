<?php

namespace App\Policies;

use App\Models\Certificate;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CertificatePolicy
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
    public function view(User $user, Certificate $certificate): bool
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
     * Belirtilen sertifikayı kullanıcının güncelleyip güncelleyemeyeceğini belirler.
     * Kullanıcı, sadece kendi sertifikasını güncelleyebilir.
     */
    public function update(User $user, Certificate $certificate): bool
    {
        // Giriş yapmış kullanıcının ID'si, sertifikanın user_id'si ile eşleşiyorsa true döner.
        return $user->id === $certificate->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    /**
     * Belirtilen sertifikayı kullanıcının silip silemeyeceğini belirler.
     * Kullanıcı, sadece kendi sertifikasını silebilir.
     */
    public function delete(User $user, Certificate $certificate): bool
    {
        // Giriş yapmış kullanıcının ID'si, sertifikanın user_id'si ile eşleşiyorsa true döner.
        return $user->id === $certificate->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Certificate $certificate): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Certificate $certificate): bool
    {
        return false;
    }
}
