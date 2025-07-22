<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExperienceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
        /**
     * Bu isteği yapmaya kullanıcının yetkisi olup olmadığını belirler.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        // Sadece giriş yapmış kullanıcıların bu isteği yapmasına izin veriyoruz.
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
        // İş deneyimi formu için doğrulama kuralları.
        return [
            'title' => 'required|string|max:255', // Pozisyon başlığı, zorunlu ve en fazla 255 karakter.
            'company' => 'required|string|max:255', // Şirket adı, zorunlu ve en fazla 255 karakter.
            'location' => 'nullable|string|max:255', // Konum, isteğe bağlı.
            'employment_type' => 'required|string|max:255', // Çalışma şekli (Tam Zamanlı, Yarı Zamanlı vb.), zorunlu.
            'description' => 'nullable|string', // İş tanımı, isteğe bağlı.
            'start_date' => 'required|date', // Başlangıç tarihi, zorunlu ve geçerli bir tarih formatında olmalı.
            'end_date' => 'nullable|date|after_or_equal:start_date', // Bitiş tarihi, isteğe bağlı ve başlangıç tarihinden sonra veya eşit olmalı.
        ];
    }
}
