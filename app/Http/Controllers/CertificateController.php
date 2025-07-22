<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Http\Requests\StoreCertificateRequest; // Request'i StoreCertificateRequest olarak güncelliyoruz

class CertificateController extends Controller
{
    /**
     * Giriş yapmış kullanıcının sertifikalarını listeler.
     * En yeniden eskiye doğru sıralar ve sayfalama uygular.
     */
    public function index()
    {
        // Kullanıcının sertifikalarını al ve sayfala
        $certificates = auth()->user()->certificates()->latest()->paginate(10);

        // View'a verileri gönder
        return view('certificates.index', compact('certificates'));
    }

    /**
     * Yeni bir sertifika oluşturma formunu gösterir.
     */
    public function create()
    {
        // create.blade.php view'ını döndür
        return view('certificates.create');
    }

    /**
     * Yeni oluşturulan sertifikayı veritabanına kaydeder.
     * Gelen istek StoreCertificateRequest tarafından doğrulanır.
     */
    public function store(StoreCertificateRequest $request)
    {
        // Doğrulanmış veriyi al ve kullanıcının sertifikalarına ekle
        auth()->user()->certificates()->create($request->validated());

        // Başarı mesajıyla index sayfasına yönlendir
        return redirect()->route('certificates.index')
                         ->with('success', 'Sertifika başarıyla eklendi.');
    }

    /*
     * Tek bir kaynağı gösterme işlemi bu modülde kullanılmayacağı için show metodu kaldırılmıştır.
     * Detaylar index sayfasında gösterilmektedir.
     */

    /**
     * Belirtilen sertifikayı düzenleme formunu gösterir.
     * İşlemden önce CertificatePolicy üzerinden yetki kontrolü yapılır.
     */
    public function edit(Certificate $certificate)
    {
        // Kullanıcının bu kaydı güncelleme yetkisi var mı kontrol et
        $this->authorize('update', $certificate);

        // edit.blade.php view'ını ve ilgili veriyi döndür
        return view('certificates.edit', compact('certificate'));
    }

    /**
     * Veritabanındaki belirtilen sertifikayı günceller.
     * İşlemden önce yetki kontrolü ve veri doğrulaması yapılır.
     */
    public function update(StoreCertificateRequest $request, Certificate $certificate)
    {
        // Kullanıcının bu kaydı güncelleme yetkisi var mı kontrol et
        $this->authorize('update', $certificate);

        // Doğrulanmış veri ile kaydı güncelle
        $certificate->update($request->validated());

        // Başarı mesajıyla index sayfasına yönlendir
        return redirect()->route('certificates.index')
                         ->with('success', 'Sertifika başarıyla güncellendi.');
    }

    /**
     * Belirtilen sertifikayı veritabanından kaldırır.
     * İşlemden önce CertificatePolicy üzerinden yetki kontrolü yapılır.
     */
    public function destroy(Certificate $certificate)
    {
        // Kullanıcının bu kaydı silme yetkisi var mı kontrol et
        $this->authorize('delete', $certificate);

        // Kaydı sil
        $certificate->delete();

        // Başarı mesajıyla index sayfasına yönlendir
        return redirect()->route('certificates.index')
                         ->with('success', 'Sertifika başarıyla silindi.');
    }
}
