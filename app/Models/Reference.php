<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reference extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'images', 'website_url', 'description', 'company_name', 'position', 'order_index', 'is_active'
    ];
    // Türkçe yorum: Referans için çoklu görsel, açıklama, şirket, pozisyon, sıralama ve aktiflik alanları tanımlandı.

    protected $casts = [
        'images' => 'array',
        'is_active' => 'boolean',
    ];
    // Türkçe yorum: images alanı JSON, is_active boolean olarak cast edildi.
}
