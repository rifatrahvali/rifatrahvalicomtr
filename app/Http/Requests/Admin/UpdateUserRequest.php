<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        // Türkçe yorum: Sadece admin yetkisi olanlar kullanıcı güncelleyebilir
        return auth()->user() && auth()->user()->hasRole('Admin');
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $this->user->id,
            'password' => 'nullable|string|min:6|confirmed',
            'roles' => 'array',
            'roles.*' => 'string|exists:roles,name',
        ];
    }
}
// Türkçe yorum: Kullanıcı güncelleme için validasyon kuralları ve yetki kontrolü. 