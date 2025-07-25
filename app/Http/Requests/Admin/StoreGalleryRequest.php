<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreGalleryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->can('manage-galleries');
        // Türkçe yorum: Sadece yetkili kullanıcılar galeri ekleyebilir.
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:200',
            'description' => 'nullable|string',
            'file' => 'required|file|mimes:jpeg,png,jpg,gif,svg,webp,heic|max:8192',
            'type' => 'required|in:image,video',
            'order' => 'nullable|integer',
        ];
        // Türkçe: HEIC formatı da dahil edildi.
    }
} 