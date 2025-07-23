<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileManagerController extends Controller
{
    /**
     * Dosya yöneticisi ana sayfası: Klasör ve dosyaları listeler.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $path = $request->get('path', '/');
        // Türkçe yorum: Belirtilen dizindeki dosya ve klasörler listeleniyor
        $directories = Storage::disk('public')->directories($path);
        $files = Storage::disk('public')->files($path);
        return view('admin.filemanager.index', compact('path', 'directories', 'files'));
    }

    /**
     * Dosya yükleme işlemi.
     */
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:8192|mimes:jpg,jpeg,png,gif,webp,pdf,docx,mp4',
            'path' => 'nullable|string',
        ]);
        $path = $request->input('path', '/');
        $file = $request->file('file');
        $fileName = uniqid() . '_' . $file->getClientOriginalName();
        $file->storeAs($path, $fileName, 'public');
        // Türkçe yorum: Dosya güvenli şekilde yüklendi
        return back()->with('success', 'Dosya başarıyla yüklendi.');
    }

    /**
     * Dosya silme işlemi.
     */
    public function delete(Request $request)
    {
        $request->validate([
            'file' => 'required|string',
        ]);
        $file = $request->input('file');
        if (Storage::disk('public')->exists($file)) {
            Storage::disk('public')->delete($file);
            // Türkçe yorum: Dosya silindi
            return back()->with('success', 'Dosya silindi.');
        }
        return back()->with('error', 'Dosya bulunamadı.');
    }

    /**
     * Dosya veya klasör yeniden adlandırma işlemi.
     */
    public function rename(Request $request)
    {
        $request->validate([
            'old' => 'required|string',
            'new' => 'required|string',
        ]);
        $old = $request->input('old');
        $new = $request->input('new');
        if (Storage::disk('public')->exists($old)) {
            Storage::disk('public')->move($old, dirname($old) . '/' . $new);
            // Türkçe yorum: Dosya veya klasör yeniden adlandırıldı
            return back()->with('success', 'Yeniden adlandırma başarılı.');
        }
        return back()->with('error', 'Dosya veya klasör bulunamadı.');
    }

    /**
     * Yeni klasör oluşturma işlemi.
     */
    public function createFolder(Request $request)
    {
        $request->validate([
            'path' => 'nullable|string',
            'folder' => 'required|string',
        ]);
        $path = $request->input('path', '/');
        $folder = $request->input('folder');
        $fullPath = trim($path, '/') . '/' . $folder;
        if (!Storage::disk('public')->exists($fullPath)) {
            Storage::disk('public')->makeDirectory($fullPath);
            // Türkçe yorum: Yeni klasör oluşturuldu
            return back()->with('success', 'Klasör oluşturuldu.');
        }
        return back()->with('error', 'Klasör zaten mevcut.');
    }
} 