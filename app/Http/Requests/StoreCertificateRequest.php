<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCertificateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    /**
     * Kullanıcının bu isteği yapmaya yetkili olup olmadığını belirler.
     * Sadece giriş yapmış kullanıcıların bu isteği yapmasına izin veriyoruz.
     */
    public function authorize(): bool
    {
        // Giriş yapmış bir kullanıcı olup olmadığını kontrol eder.
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    /**
     * İstek için geçerli olan doğrulama kurallarını alır.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            // 'name' alanı zorunludur ve en fazla 255 karakter olabilir.
            'name' => 'required|string|max:255',
            // 'issuing_organization' alanı zorunludur ve en fazla 255 karakter olabilir.
            'issuing_organization' => 'required|string|max:255',
            // 'issue_date' alanı zorunludur ve geçerli bir tarih formatında olmalıdır.
            'issue_date' => 'required|date',
            // 'expiration_date' alanı zorunlu değildir, ancak gönderilirse geçerli bir tarih formatında olmalı ve başlangıç tarihinden sonra olmalıdır.
            'expiration_date' => 'nullable|date|after_or_equal:issue_date',
            // 'credential_id' alanı zorunlu değildir ve en fazla 255 karakter olabilir.
            'credential_id' => 'nullable|string|max:255',
            // 'credential_url' alanı zorunlu değildir ve geçerli bir URL formatında olmalıdır.
            'credential_url' => 'nullable|url|max:255',
        ];
    }
}
