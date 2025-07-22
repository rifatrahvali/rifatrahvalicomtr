<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class UserProfile extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // Toplu atama ile doldurulabilecek alanları belirtiyoruz.
    // Bu, create veya update metotlarıyla bu alanların güvenli bir şekilde doldurulmasını sağlar.
    protected $fillable = [
        'user_id',
        'avatar',
        'bio',
        'location',
        'website_url',
    ];

    /**
     * Get the user that owns the profile.
     */
    // Bu profilin ait olduğu kullanıcıyı getiren ilişkiyi tanımlar.
    // 'belongsTo' ilişkisi, bu modelin başka bir modele ait olduğunu belirtir.
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
