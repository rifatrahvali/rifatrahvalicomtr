<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Türkçe: Sadece admin kullanıcılar ayarları güncelleyebilir
        return auth()->check() && auth()->user()->hasRole('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Türkçe: Tüm ayar anahtarlarını ve tiplerini dinamik olarak çekip validasyon kuralları oluşturuyoruz
        $rules = [];
        $settings = \App\Models\Setting::all();
        foreach ($settings as $setting) {
            switch ($setting->type) {
                case 'email':
                    $rules[$setting->key] = 'nullable|email';
                    break;
                case 'string':
                    $rules[$setting->key] = 'nullable|string|max:255';
                    break;
                case 'image':
                    $rules[$setting->key] = 'nullable|string'; // Gerçek projede file olabilir
                    break;
                default:
                    $rules[$setting->key] = 'nullable|string';
            }
        }
        return $rules;
    }
}
