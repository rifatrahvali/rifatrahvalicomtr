<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reference;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\StoreReferenceRequest;
use App\Http\Requests\Admin\UpdateReferenceRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log; // Türkçe: Log sınıfı kullanımı için gerekli import.

class ReferenceController extends Controller
{
    // Referansları listeler
    public function index()
    {
        $references = Reference::orderBy('order_index')->paginate(20);
        return view('admin.reference.index', compact('references'));
        // Türkçe yorum: Tüm referanslar sıralı şekilde listelenir.
    }

    // Yeni referans ekleme formu
    public function create()
    {
        return view('admin.reference.create');
        // Türkçe yorum: Yeni referans ekleme formu gösterilir.
    }

    // Referans kaydetme
    public function store(StoreReferenceRequest $request)
    {
        Log::info('Referans store fonksiyonu çalıştı', $request->all());
        // Türkçe: Store fonksiyonu tetiklendiğinde loga veri yazılır.
        $data = $request->validated();
        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $images[] = $file->store('references', 'public');
            }
        }
        $data['images'] = $images;
        $data['is_active'] = $request->boolean('is_active');
        // Türkçe: is_active alanı her zaman true/false olarak kaydedilir.
        Reference::create($data);
        Log::info('Referans başarıyla kaydedildi');
        // Türkçe: Kayıt işlemi başarılı olursa loga yazılır.
        return redirect()->route('admin.reference.index')->with('success', 'Referans eklendi.');
        // Türkçe yorum: Yeni referans kaydedilir.
    }

    // Referans düzenleme formu
    public function edit(Reference $reference)
    {
        return view('admin.reference.edit', compact('reference'));
        // Türkçe yorum: Referans düzenleme formu gösterilir.
    }

    // Referans güncelleme
    public function update(UpdateReferenceRequest $request, Reference $reference)
    {
        $data = $request->validated();
        $images = $reference->images ?? [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $images[] = $file->store('references', 'public');
            }
        }
        $data['images'] = $images;
        $reference->update($data);
        return redirect()->route('admin.reference.index')->with('success', 'Referans güncellendi.');
        // Türkçe yorum: Referans güncellenir.
    }

    // Referans silme
    public function destroy(Reference $reference)
    {
        $images = is_array($reference->images) ? $reference->images : json_decode($reference->images, true);
        if ($images) {
            foreach ($images as $img) {
                Storage::disk('public')->delete($img);
            }
        }
        $reference->delete();
        return redirect()->route('admin.reference.index')->with('success', 'Referans silindi.');
        // Türkçe yorum: Referans ve görselleri silinir.
    }

    // Sıralama güncelleme (drag&drop sonrası ajax)
    public function updateOrder(Request $request)
    {
        $order = $request->input('order', []);
        foreach ($order as $i => $id) {
            Reference::where('id', $id)->update(['order_index' => $i]);
        }
        return response()->json(['status' => 'ok']);
        // Türkçe yorum: Referansların sırası güncellenir.
    }
} 