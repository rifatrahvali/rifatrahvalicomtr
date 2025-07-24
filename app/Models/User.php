<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens; // Sanctum'un token yönetimi için gerekli olan trait'i ekliyoruz.
use Spatie\Permission\Traits\HasRoles; // Spatie'nin rol ve izin yönetimi için gerekli olan trait'i ekliyoruz.
use Illuminate\Database\Eloquent\SoftDeletes; // SoftDeletes ile silinen kayıtlar geri alınabilir
// use PragmaRX\Google2FALaravel\Support\Traits\Google2FA; // Google 2FA için gerekli olan trait'i ekliyoruz. (Geçici olarak devre dışı)

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
        // HasApiTokens, kullanıcının API token'ları oluşturmasını ve yönetmesini sağlar.
        // HasRoles, kullanıcıya rol ve izin atama yetenekleri kazandırır.
        use HasFactory, Notifiable, HasApiTokens, HasRoles, SoftDeletes; // Google2FA geçici olarak kaldırıldı

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

    /**
     * Get the experiences for the user.
     */
    // Kullanıcının tüm deneyim kayıtlarını getiren ilişkiyi tanımlar.
    // 'hasMany' ilişkisi, bir kullanıcının birden çok deneyimi olabileceğini belirtir.
    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }

    /**
     * Get the education records for the user.
     */
    // Kullanıcının tüm eğitim kayıtlarını getiren ilişkiyi tanımlar.
    // 'hasMany' ilişkisi, bir kullanıcının birden çok eğitim kaydı olabileceğini belirtir.
    public function educations()
    {
        return $this->hasMany(Education::class);
    }

    /**
     * Get the certificates for the user.
     */
    // Kullanıcının tüm sertifika kayıtlarını getiren ilişkiyi tanımlar.
    // 'hasMany' ilişkisi, bir kullanıcının birden çok sertifika kaydı olabileceğini belirtir.
    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }

    /**
     * Get the about section associated with the user.
     */
    // Kullanıcının hakkımda bölümünü getiren ilişkiyi tanımlar.
    // 'hasOne' ilişkisi, bir kullanıcının sadece bir hakkımda kaydı olabileceğini belirtir.
    public function about()
    {
        return $this->hasOne(About::class);
    }

    public function skills()
    {
        return $this->morphToMany(Skill::class, 'skillable');
        // Türkçe: Kullanıcının yetenekleri (skills) ile morphToMany ilişki.
    }

    /**
     * Get the courses for the user.
     */
    // Kullanıcının tüm kurs kayıtlarını getiren ilişkiyi tanımlar.
    // 'hasMany' ilişkisi, bir kullanıcının birden çok kurs kaydı olabileceğini belirtir.
    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
