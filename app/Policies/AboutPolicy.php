<?php

namespace App\Policies;

use App\Models\About;
use App\Models\User;

class AboutPolicy
{
    // Türkçe yorum: Sadece kendi hakkımda kaydını güncelleyebilir
    public function update(User $user, About $about)
    {
        return $user->id === $about->user_id;
    }

    // Türkçe yorum: Sadece kendi hakkımda kaydını silebilir
    public function delete(User $user, About $about)
    {
        return $user->id === $about->user_id;
    }
} 