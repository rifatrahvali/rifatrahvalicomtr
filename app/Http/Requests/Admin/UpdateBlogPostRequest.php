<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBlogPostRequest extends FormRequest
{
    public function authorize()
    {
        $post = $this->route('blog'); // Route model binding ile BlogPost modelini alır
        return auth()->check() && auth()->user()->can('update', $post);
        // Türkçe yorum: Sadece giriş yapmış ve yetkili kullanıcılar blog yazısı güncelleyebilir. Model doğru şekilde policy'ye iletilir.
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'required|in:draft,published',
            'published_at' => 'nullable|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:4096',
        ];
        // Türkçe yorum: Başlık ve içerik zorunlu, durum sadece draft veya published olabilir, yayın tarihi opsiyonel ve tarih formatında olmalı.
        // Türkçe yorum: Görsel yükleme alanı için dosya tipi ve boyut validasyonu eklendi.
    }
} 