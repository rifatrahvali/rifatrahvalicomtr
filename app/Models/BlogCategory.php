<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BlogCategory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // Toplu atama ile doldurulabilir alanları belirtir.
    protected $fillable = [
        'name',
        'slug',
        'parent_id',
    ];

    /**
     * Get the parent category of this category.
     */
    // Bir kategorinin ebeveyn kategorisini getiren ilişki (kendine referans).
    // 'belongsTo' ile bu kategorinin bir üst kategoriye ait olduğunu belirtiriz.
    public function parent()
    {
        return $this->belongsTo(BlogCategory::class, 'parent_id');
    }

    /**
     * Get the child categories of this category.
     */
    // Bir kategorinin alt kategorilerini getiren ilişki (kendine referans).
    // 'hasMany' ile bu kategorinin birden çok alt kategorisi olabileceğini belirtiriz.
    public function children()
    {
        return $this->hasMany(BlogCategory::class, 'parent_id');
    }

    /**
     * Get the posts for the blog category.
     */
    // Bu kategoriye ait tüm blog yazılarını getiren ilişki.
    public function posts()
    {
        return $this->hasMany(BlogPost::class);
    }
}
