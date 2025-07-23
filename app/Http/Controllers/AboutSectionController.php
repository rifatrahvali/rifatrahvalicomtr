<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AboutSectionController extends Controller
{
    // Hakkımda bölümü listeleme
    public function index()
    {
        // Giriş yapan kullanıcının hakkımda bölümlerini sıralı şekilde alıyoruz.
        $abouts = About::where('user_id', Auth::id())->orderBy('order', 'asc')->get();
        return view('abouts.index', compact('abouts'));
        // Türkçe yorum: Kullanıcıya ait hakkımda bölümlerini listeler.
    }

    // Yeni hakkımda bölümü oluşturma formu
    public function create()
    {
        return view('abouts.create');
        // Türkçe yorum: Yeni hakkımda bölümü ekleme formunu gösterir.
    }

    // Hakkımda bölümü kaydetme
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'description' => 'required|string',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);
        $validated['user_id'] = Auth::id();
        $validated['is_active'] = $request->has('is_active');
        About::create($validated);
        return redirect()->route('abouts.index')->with('success', 'Hakkımda bölümü eklendi.');
        // Türkçe yorum: Formdan gelen verilerle yeni bir hakkımda bölümü oluşturur.
    }

    // Hakkımda bölümü düzenleme formu
    public function edit(About $about)
    {
        $this->authorize('update', $about);
        return view('abouts.edit', compact('about'));
        // Türkçe yorum: Seçilen hakkımda bölümünü düzenleme formunu gösterir.
    }

    // Hakkımda bölümü güncelleme
    public function update(Request $request, About $about)
    {
        $this->authorize('update', $about);
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'description' => 'required|string',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);
        $validated['is_active'] = $request->has('is_active');
        $about->update($validated);
        return redirect()->route('abouts.index')->with('success', 'Hakkımda bölümü güncellendi.');
        // Türkçe yorum: Seçilen hakkımda bölümünü günceller.
    }

    // Hakkımda bölümü silme
    public function destroy(About $about)
    {
        $this->authorize('delete', $about);
        $about->delete();
        return redirect()->route('abouts.index')->with('success', 'Hakkımda bölümü silindi.');
        // Türkçe yorum: Seçilen hakkımda bölümünü siler.
    }

    // Sıralama işlemi (drag&drop sonrası ajax ile)
    public function reorder(Request $request)
    {
        $orders = $request->input('orders');
        foreach ($orders as $id => $order) {
            About::where('id', $id)->where('user_id', Auth::id())->update(['order' => $order]);
        }
        return response()->json(['status' => 'success']);
        // Türkçe yorum: Hakkımda bölümlerinin sırasını günceller.
    }
} 