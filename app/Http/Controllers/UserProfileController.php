<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserProfileRequest;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user()->load(['profile', 'about']);
        return view('profile.show', compact('user'));
        // Türkçe: Kullanıcı kendi profilini görüntüleyebilsin diye index metodu dolduruldu.
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        // Oturum açmış kullanıcıyı ve ilişkili profil, about modellerini alıyoruz.
        // Eager loading ile ilişkileri yüklüyoruz.
        $user = auth()->user()->load(['profile', 'about']);

        // Kullanıcıyı profil düzenleme görünümüne yönlendiriyoruz.
        // Henüz view'ı oluşturmadık, bir sonraki adımda oluşturacağız.
        return view('profile.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserProfileRequest $request)
    {
        // Formdan gelen doğrulanmış verileri alıyoruz.
        $validatedData = $request->validated();
        $user = auth()->user();

        // User modelini güncelle (isim, email vb.)
        $user->update([
            'name' => $validatedData['first_name'] . ' ' . $validatedData['last_name'],
            'email' => $validatedData['email'],
        ]);

        // UserProfile modelini güncelle veya oluştur
        $profileData = [
            'first_name' => \App\Services\Security\InputSanitizer::clean($validatedData['first_name']),
            'last_name' => \App\Services\Security\InputSanitizer::clean($validatedData['last_name']),
            'title' => \App\Services\Security\InputSanitizer::clean($validatedData['title']),
            'phone' => \App\Services\Security\InputSanitizer::clean($validatedData['phone']),
            'website' => \App\Services\Security\InputSanitizer::clean($validatedData['website']),
            'address' => \App\Services\Security\InputSanitizer::clean($validatedData['address']),
            'social_links' => $validatedData['social_links'] ?? [],
        ];

        // Profil resmi yükleme
        if ($request->hasFile('profile_image')) {
            // Eski resmi sil (varsa)
            if ($user->profile && $user->profile->profile_image) {
                Storage::disk('public')->delete($user->profile->profile_image);
            }
            $profileData['profile_image'] = $request->file('profile_image')->store('profile-images', 'public');
        }

        $user->profile()->updateOrCreate(['user_id' => $user->id], $profileData);

        // About modelini güncelle veya oluştur
        $aboutData = [
            'bio' => isset($validatedData['about']['bio']) ? \App\Services\Security\InputSanitizer::clean($validatedData['about']['bio']) : null,
        ];

        // CV yükleme
        if ($request->hasFile('about.cv_path')) {
            // Eski CV'yi sil (varsa)
            if ($user->about && $user->about->cv_path) {
                Storage::disk('public')->delete($user->about->cv_path);
            }
            $aboutData['cv_path'] = $request->file('about.cv_path')->store('cvs', 'public');
        }

        if (!empty(array_filter($aboutData))) {
            $user->about()->updateOrCreate(['user_id' => $user->id], $aboutData);
        }

        // Başarılı mesajıyla birlikte profili düzenleme sayfasına geri yönlendir.
        return redirect('/profile')->with('success', 'Profil başarıyla güncellendi.');
        // Türkçe: Profil güncellendikten sonra kullanıcı kendi profilini görebilsin diye /profile adresine yönlendirildi.
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
