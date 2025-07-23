<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Reference;

class ReferencePolicy
{
    // Tüm referans işlemleri için admin veya manage-references izni gerekir
    public function before(User $user, $ability)
    {
        if ($user->hasRole('admin') || $user->can('manage-references')) {
            return true;
        }
        return false;
        // Türkçe yorum: Sadece admin veya manage-references izni olanlar işlem yapabilir.
    }

    public function viewAny(User $user) { return true; }
    public function view(User $user, Reference $reference) { return true; }
    public function create(User $user) { return true; }
    public function update(User $user, Reference $reference) { return true; }
    public function delete(User $user, Reference $reference) { return true; }
} 