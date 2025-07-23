<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\BlogCategory;
use App\Models\Tag;

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

    /**
     * Bu yazının ait olduğu etiketleri getirir.
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'blog_post_tag');
        // Türkçe yorum: Blog yazısı ile etiketler arasında çoktan-çoğa ilişki.
    }

    /**
     * Yazının tahmini okuma süresini (dakika) döndürür.
     * Türkçe yorum: Ortalama 200 kelime/dakika üzerinden hesaplanır.
     */
    public function readingTime()
    {
        $text = strip_tags($this->content);
        $wordCount = str_word_count($text);
        $minutes = ceil($wordCount / 200);
        return max(1, $minutes);
        // Türkçe yorum: Okuma süresi en az 1 dakika olacak şekilde hesaplanır.
    }

    /**
     * Benzer (ilgili) yazıları döndürür.
     * Türkçe yorum: Aynı kategori ve ortak etikete sahip yayınlanmış yazılar.
     */
    public function relatedPosts($limit = 3)
    {
        $query = BlogPost::where('id', '!=', $this->id)
            ->where('status', 'published')
            ->where(function($q) {
                $q->where('blog_category_id', $this->blog_category_id)
                  ->orWhereHas('tags', function($tagQ) {
                      $tagQ->whereIn('tags.id', $this->tags->pluck('id'));
                  });
            })
            ->orderByDesc('published_at')
            ->limit($limit);
        return $query->get();
        // Türkçe yorum: Aynı kategori veya ortak etikete sahip en yeni 3 yazı döndürülür.
    }
}
