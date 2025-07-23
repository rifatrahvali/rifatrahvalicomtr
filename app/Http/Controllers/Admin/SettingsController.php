<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\UpdateSettingsRequest;

class SettingsController extends Controller
{
    public function __construct()
    {
        // Sadece admin rolüne sahip kullanıcılar erişebilir
        $this->middleware(['auth', 'role:admin']);
    }

    /**
     * Ayarları listeler ve admin panelde gösterir
     */
    public function index()
    {
        // Tüm ayarları gruplarına göre çekiyoruz
        $settings = Setting::all()->groupBy('group');
        // Türkçe: Ayarları admin panelde göstermek için view'a aktarıyoruz
        return view('admin.settings.general', compact('settings'));
    }

    /**
     * Ayarları günceller
     */
    public function update(UpdateSettingsRequest $request)
    {
        // Tüm ayarları döngüyle güncelliyoruz
        foreach ($request->except(['_token', '_method']) as $key => $value) {
            $setting = Setting::where('key', $key)->first();
            if ($setting) {
                $setting->update([
                    'value' => $value,
                    'updated_by' => Auth::id(),
                ]);
            }
        }
        // Türkçe: Başarılı güncelleme sonrası geri dön
        return redirect()->back()->with('success', 'Ayarlar başarıyla güncellendi.');
    }
}
