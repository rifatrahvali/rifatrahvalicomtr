<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'original_name',
        'file_name',
        'disk',
        'path',
        'webp_path',
        'mime_type',
        'size',
        'width',
        'height',
        'type',
        'alt',
        'optimized',
    ];
    // Türkçe yorum: Media modeli, yüklenen dosyaların meta verilerini temsil eder.
} 