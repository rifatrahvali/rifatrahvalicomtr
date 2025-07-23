<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LearnedExperience extends Model
{
    use HasFactory;

    // Türkçe yorum: Toplu atama ile doldurulabilecek alanlar
    protected $fillable = [
        'experience_id',
        'description',
        'activity_field',
        'activity_tags',
    ];

    // Türkçe yorum: activity_tags alanı JSON olarak cast edilir
    protected $casts = [
        'activity_tags' => 'array',
    ];

    // Türkçe yorum: Bu kazanımın ait olduğu deneyim kaydını getirir
    public function experience()
    {
        return $this->belongsTo(Experience::class);
    }
}
// Türkçe yorum: Bu model, iş deneyimlerinden elde edilen kazanımları temsil eder. 