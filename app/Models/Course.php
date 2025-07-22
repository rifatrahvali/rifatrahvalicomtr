<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Course extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // Toplu atama ile hangi alanların doldurulabileceğini belirtir.
    protected $fillable = [
        'user_id',
        'name',
        'organization',
        'completion_date',
        'credential_url',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    // Belirtilen alanların tür dönüşümlerini yönetir.
    protected $casts = [
        'completion_date' => 'date',
    ];

    /**
     * Get the user that owns the course.
     */
    // Kursun ait olduğu kullanıcıyı getiren ilişki.
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
