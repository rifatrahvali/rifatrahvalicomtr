<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Bu isteği sadece giriş yapmış kullanıcılar yapabilir.
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
            // Temel Profil Bilgileri
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'required|string|email|max:255|unique:users,email,' . auth()->id(),
            'website' => 'nullable|url|max:255',
            'address' => 'nullable|string|max:255',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

            // Sosyal Medya Bilgileri
            'social_links.linkedin' => 'nullable|url|max:255',
            'social_links.github' => 'nullable|url|max:255',
            'social_links.twitter' => 'nullable|url|max:255',

            // Hakkında Bölümü
            'about.bio' => 'nullable|string',
            'about.cv_path' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ];
    }
}
