<?php

namespace App\Policies;

use App\Models\User;
use App\Models\BlogPost;

class BlogPostPolicy
{
    /**
     * Sadece admin rolüne sahip kullanıcılar blog yazısı oluşturabilir.
     */
    public function create(User $user)
    {
        return $user->hasRole('admin');
        // Türkçe yorum: Sadece admin rolü olan kullanıcılar blog yazısı ekleyebilir.
    }

    /**
     * Sadece admin rolüne sahip kullanıcılar blog yazısı güncelleyebilir.
     */
    public function update(User $user, BlogPost $post)
    {
        return $user->hasRole('admin');
        // Türkçe yorum: Sadece admin rolü olan kullanıcılar blog yazısı güncelleyebilir.
    }

    /**
     * Sadece admin rolüne sahip kullanıcılar blog yazısı silebilir.
     */
    public function delete(User $user, BlogPost $post)
    {
        return $user->hasRole('admin');
        // Türkçe yorum: Sadece admin rolü olan kullanıcılar blog yazısı silebilir.
    }

    /**
     * Sadece admin rolüne sahip kullanıcılar tüm blog yazılarını listeleyebilir.
     */
    public function viewAny(User $user)
    {
        return $user->hasRole('admin');
        // Türkçe yorum: Sadece admin rolü olan kullanıcılar tüm blog yazılarını listeleyebilir.
    }

    /**
     * Sadece admin rolüne sahip kullanıcılar blog yazısı detayını görebilir.
     */
    public function view(User $user, BlogPost $post)
    {
        return $user->hasRole('admin');
        // Türkçe yorum: Sadece admin rolü olan kullanıcılar blog yazısı detayını görebilir.
    }
} 