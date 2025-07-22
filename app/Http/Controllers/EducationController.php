<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Http\Requests\StoreEducationRequest; // Request'i Request'ten StoreEducationRequest'e güncelliyoruz

class EducationController extends Controller
{
    /**
     * Giriş yapmış kullanıcının eğitim bilgilerini listeler.
     * En yeniden eskiye doğru sıralar ve sayfalama uygular.
     */
    public function index()
    {
        // Kullanıcının eğitimlerini al ve sayfala
        $educations = auth()->user()->educations()->latest()->paginate(10);

        // View'a verileri gönder
        return view('educations.index', compact('educations'));
    }

    /**
     * Yeni bir eğitim bilgisi oluşturma formunu gösterir.
     */
    public function create()
    {
        // create.blade.php view'ını döndür
        return view('educations.create');
    }

    /**
     * Yeni oluşturulan eğitim bilgisini veritabanına kaydeder.
     * Gelen istek StoreEducationRequest tarafından doğrulanır.
     */
    public function store(StoreEducationRequest $request)
    {
        // Doğrulanmış veriyi al ve kullanıcının eğitimlerine ekle
        auth()->user()->educations()->create($request->validated());

        // Başarı mesajıyla index sayfasına yönlendir
        return redirect()->route('educations.index')
                         ->with('success', 'Eğitim bilgisi başarıyla eklendi.');
    }

    /*
     * Tek bir kaynağı gösterme işlemi bu modülde kullanılmayacağı için show metodu kaldırılmıştır.
     * Detaylar index sayfasında gösterilmektedir.
     */

    /**
     * Belirtilen eğitim bilgisini düzenleme formunu gösterir.
     * İşlemden önce EducationPolicy üzerinden yetki kontrolü yapılır.
     */
    public function edit(Education $education)
    {
        // Kullanıcının bu kaydı güncelleme yetkisi var mı kontrol et
        $this->authorize('update', $education);

        // edit.blade.php view'ını ve ilgili veriyi döndür
        return view('educations.edit', compact('education'));
    }

    /**
     * Veritabanındaki belirtilen eğitim bilgisini günceller.
     * İşlemden önce yetki kontrolü ve veri doğrulaması yapılır.
     */
    public function update(StoreEducationRequest $request, Education $education)
    {
        // Kullanıcının bu kaydı güncelleme yetkisi var mı kontrol et
        $this->authorize('update', $education);

        // Doğrulanmış veri ile kaydı güncelle
        $education->update($request->validated());

        // Başarı mesajıyla index sayfasına yönlendir
        return redirect()->route('educations.index')
                         ->with('success', 'Eğitim bilgisi başarıyla güncellendi.');
    }

    /**
     * Belirtilen eğitim bilgisini veritabanından kaldırır.
     * İşlemden önce EducationPolicy üzerinden yetki kontrolü yapılır.
     */
    public function destroy(Education $education)
    {
        // Kullanıcının bu kaydı silme yetkisi var mı kontrol et
        $this->authorize('delete', $education);

        // Kaydı sil
        $education->delete();

        // Başarı mesajıyla index sayfasına yönlendir
        return redirect()->route('educations.index')
                         ->with('success', 'Eğitim bilgisi başarıyla silindi.');
    }
}
