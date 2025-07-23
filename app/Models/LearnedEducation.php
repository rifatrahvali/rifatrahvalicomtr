<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LearnedEducation extends Model
{
    use HasFactory;

    // Türkçe yorum: Toplu atama ile doldurulabilecek alanlar
    protected $fillable = [
        'education_id',
        'core_learnings',
        'general_learnings',
    ];

    // Türkçe yorum: JSON alanlar cast edilir
    protected $casts = [
        'core_learnings' => 'array',
        'general_learnings' => 'array',
    ];

    // Türkçe yorum: Bu kazanımın ait olduğu eğitim kaydını getirir
    public function education()
    {
        return $this->belongsTo(Education::class);
    }
}
// Türkçe yorum: Bu model, eğitimlerden elde edilen kazanımları temsil eder. 