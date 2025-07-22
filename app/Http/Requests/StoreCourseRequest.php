<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Bu isteği sadece giriş yapmış kullanıcıların yapabileceğini belirtir.
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // 'name' alanı zorunlu ve en fazla 255 karakter olmalıdır.
            'name' => 'required|string|max:255',
            // 'organization' alanı zorunlu ve en fazla 255 karakter olmalıdır.
            'organization' => 'required|string|max:255',
            // 'completion_date' alanı zorunlu ve geçerli bir tarih formatında olmalıdır.
            'completion_date' => 'required|date',
            // 'credential_url' alanı bir URL olmalı ve boş bırakılabilir.
            'credential_url' => 'nullable|url|max:255',
        ];
    }
}
