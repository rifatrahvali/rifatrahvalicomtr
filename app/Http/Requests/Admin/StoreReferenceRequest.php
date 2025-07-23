<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreReferenceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->can('manage-references');
        // Türkçe yorum: Sadece yetkili kullanıcılar referans ekleyebilir.
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:200',
            'images' => 'required|array',
            'images.*' => 'file|mimes:jpeg,png,jpg,gif,svg|max:8192',
            'website_url' => 'nullable|url',
            'description' => 'nullable|string',
            'company_name' => 'nullable|string|max:200',
            'position' => 'nullable|string|max:150',
            'order_index' => 'nullable|integer',
            'is_active' => 'boolean',
        ];
        // Türkçe yorum: Referans ekleme için validasyon kuralları.
    }
} 