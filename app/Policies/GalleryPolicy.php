<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Gallery;

class GalleryPolicy
{
    // Tüm galeri işlemleri için admin veya manage-galleries izni gerekir
    public function before(User $user, $ability)
    {
        if ($user->hasRole('admin') || $user->hasRole('Admin') || $user->can('manage-galleries')) {
            return true;
        }
        return false;
        // Türkçe: Hem 'admin' hem 'Admin' rolü ve manage-galleries izni kontrolü yapılır.
    }

    public function viewAny(User $user) { return true; }
    public function view(User $user, Gallery $gallery) { return true; }
    public function create(User $user) { return true; }
    public function update(User $user, Gallery $gallery) { return true; }
    public function delete(User $user, Gallery $gallery) { return true; }
} 