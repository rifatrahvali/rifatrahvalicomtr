<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class MediaUploadRequest extends FormRequest
{
    public function authorize()
    {
        return true;
        // Türkçe yorum: API'den gelen istekler için yetkilendirme (gerekirse değiştirilebilir).
    }

    public function rules()
    {
        return [
            'file' => 'required|file|mimes:jpeg,png,jpg,gif,webp|max:8192',
            // Türkçe yorum: Sadece resim dosyaları ve maksimum 8MB.
            'alt' => 'nullable|string|max:255',
        ];
        // Türkçe yorum: Dosya ve alt text için validasyon kuralları.
    }
} 