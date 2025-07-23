<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize()
    {
        // Türkçe yorum: Sadece admin yetkisi olanlar kullanıcı ekleyebilir
        return auth()->user() && auth()->user()->hasRole('Admin');
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'roles' => 'array',
            'roles.*' => 'string|exists:roles,name',
        ];
    }
}
// Türkçe yorum: Kullanıcı ekleme için validasyon kuralları ve yetki kontrolü. 