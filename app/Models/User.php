<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; // Sanctum'un token yönetimi için gerekli olan trait'i ekliyoruz.
use Spatie\Permission\Traits\HasRoles; // Spatie'nin rol ve izin yönetimi için gerekli olan trait'i ekliyoruz.
use PragmaRX\Google2FALaravel\Support\Traits\Google2FA; // Google 2FA için gerekli olan trait'i ekliyoruz.

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
        // HasApiTokens, kullanıcının API token'ları oluşturmasını ve yönetmesini sağlar.
        // HasRoles, kullanıcıya rol ve izin atama yetenekleri kazandırır.
        use HasFactory, Notifiable, HasApiTokens, HasRoles, Google2FA;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
        protected $hidden = [
        'password',
        'remember_token',
        'google2fa_secret', // 2FA gizli anahtarını güvenlik nedeniyle gizliyoruz.
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the profile associated with the user.
     */
    // Kullanıcının profil bilgilerini getiren ilişkiyi tanımlar.
    // 'hasOne' ilişkisi, bir kullanıcının bir adet profili olduğunu belirtir.
    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }
}
