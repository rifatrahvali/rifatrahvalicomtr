<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Http\Requests\StoreExperienceRequest;

class ExperienceController extends Controller
{
    /**
     * Giriş yapmış kullanıcının iş deneyimlerini listeler.
     * Bu metod, kimlik doğrulaması yapılmış kullanıcının tüm deneyimlerini alır,
     * en yeniden eskiye doğru sıralar ve sayfalama uygular.
     */
    public function index()
    {
        $experiences = auth()->user()->experiences()->latest()->paginate(10);
        return view('experiences.index', compact('experiences'));
    }

    /**
     * Yeni bir iş deneyimi oluşturma formunu gösterir.
     */
    public function create()
    {
        return view('experiences.create');
    }

    /**
     * Yeni oluşturulan iş deneyimini veritabanına kaydeder.
     * StoreExperienceRequest ile gelen veriyi doğrular ve kaydeder.
     */
    public function store(StoreExperienceRequest $request)
    {
        auth()->user()->experiences()->create($request->validated());

        return redirect()->route('experiences.index')
                         ->with('success', 'İş deneyimi başarıyla eklendi.');
    }

    /**
     * Belirtilen iş deneyimini düzenleme formunu gösterir.
     * Policy üzerinden yetki kontrolü yapar.
     */
    public function edit(Experience $experience)
    {
        $this->authorize('update', $experience);
        return view('experiences.edit', compact('experience'));
    }

    /**
     * Veritabanındaki belirtilen iş deneyimini günceller.
     * Policy üzerinden yetki kontrolü yapar ve veriyi günceller.
     */
    public function update(StoreExperienceRequest $request, Experience $experience)
    {
        $this->authorize('update', $experience);
        $experience->update($request->validated());

        return redirect()->route('experiences.index')
                         ->with('success', 'İş deneyimi başarıyla güncellendi.');
    }

    /**
     * Belirtilen iş deneyimini veritabanından kaldırır.
     * Policy üzerinden yetki kontrolü yapar ve kaydı siler.
     */
    public function destroy(Experience $experience)
    {
        $this->authorize('delete', $experience);
        $experience->delete();

        return redirect()->route('experiences.index')
                         ->with('success', 'İş deneyimi başarıyla silindi.');
    }
}

