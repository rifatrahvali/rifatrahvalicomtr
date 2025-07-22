<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\BlogCategory;

class BlogPost extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // Toplu atama ile doldurulabilir alanları belirtir.
    protected $fillable = [
        'user_id',
        'blog_category_id',
        'title',
        'slug',
        'content',
        'image',
        'status',
        'published_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    // Belirtilen alanların otomatik olarak tür dönüşümünü sağlar.
    protected $casts = [
        'published_at' => 'datetime',
    ];

    /**
     * Get the user that owns the blog post.
     */
    // Bu yazının ait olduğu kullanıcıyı (yazarı) getiren ilişki.
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the category that the blog post belongs to.
     */
    // Bu yazının ait olduğu kategoriyi getiren ilişki.
    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id');
    }
}
