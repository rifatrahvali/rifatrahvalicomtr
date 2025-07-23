<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gallery extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // Toplu atama ile doldurulabilir alanları belirtir.
    protected $fillable = [
        'title', 'description', 'path', 'type', 'order', 'alt_text'
    ];
    // Türkçe yorum: SEO ve erişilebilirlik için alt_text alanı eklendi.
}
