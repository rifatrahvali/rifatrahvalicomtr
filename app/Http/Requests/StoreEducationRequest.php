<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEducationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    /**
     * Bu isteği yapmaya kullanıcının yetkisi olup olmadığını belirler.
     * Sadece giriş yapmış kullanıcıların bu isteği yapmasına izin veriyoruz.
     * Detaylı yetkilendirme (Policy) Controller katmanında yapılacaktır.
     */
    public function authorize(): bool
    {
        // Sadece kimliği doğrulanmış kullanıcıların bu isteği yapmasına izin ver.
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
        // Eğitim bilgileri için doğrulama kurallarını tanımlıyoruz.
        return [
            'school' => ['required', 'string', 'max:255'], // Okul adı zorunlu, metin ve en fazla 255 karakter olmalı.
            'degree' => ['required', 'string', 'max:255'], // Derece zorunlu, metin ve en fazla 255 karakter olmalı.
            'field_of_study' => ['required', 'string', 'max:255'], // Bölüm zorunlu, metin ve en fazla 255 karakter olmalı.
            'description' => ['nullable', 'string', 'max:5000'], // Açıklama zorunlu değil, metin ve en fazla 5000 karakter olabilir.
            'start_date' => ['required', 'date'], // Başlangıç tarihi zorunlu ve geçerli bir tarih formatında olmalı.
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'], // Bitiş tarihi zorunlu değil, ancak girilirse başlangıç tarihinden sonra veya ona eşit olmalı.
        ];
    }
}
