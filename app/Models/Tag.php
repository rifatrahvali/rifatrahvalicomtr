<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory;

    // Türkçe yorum: Toplu atama ile doldurulabilir alanlar
    protected $fillable = [
        'name',
        'slug',
    ];

    // Türkçe yorum: Bir etiketin ait olduğu blog yazılarını getirir
    public function posts()
    {
        return $this->belongsToMany(BlogPost::class, 'blog_post_tag');
    }
} 