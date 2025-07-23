<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGalleryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->can('manage-galleries');
        // Türkçe yorum: Sadece yetkili kullanıcılar galeri güncelleyebilir.
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:200',
            'description' => 'nullable|string',
            'file' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,mp4,mov,avi|max:8192',
            'type' => 'required|in:image,video',
            'order' => 'nullable|integer',
        ];
        // Türkçe yorum: Galeri güncelleme için validasyon kuralları.
    }
} 