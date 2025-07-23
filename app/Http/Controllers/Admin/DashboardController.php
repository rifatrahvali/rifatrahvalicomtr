<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\BlogPost;
use App\Models\Gallery;
use App\Models\Reference;
use App\Models\BlogCategory;

class DashboardController extends Controller
{
    /**
     * Admin paneli ana sayfasını gösterir.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Türkçe yorum: Dashboard için temel istatistikler hazırlanıyor
        $istatistikler = [
            'kullanici' => User::count(),
            'blog' => BlogPost::count(),
            'galeri' => Gallery::count(),
            'referans' => Reference::count(),
            'kategori' => BlogCategory::count(),
        ];
        // Türkçe yorum: Son 6 ayda eklenen blog yazısı sayısı aylık olarak çekiliyor
        $aylar = collect(range(0, 5))->map(function($i) {
            return now()->subMonths($i)->format('Y-m');
        })->reverse()->values();
        $blogAylik = $aylar->map(function($ay) {
            return BlogPost::whereYear('created_at', substr($ay, 0, 4))
                ->whereMonth('created_at', substr($ay, 5, 2))
                ->count();
        });
        // Türkçe yorum: Son 5 blog ve kullanıcı
        $sonBloglar = BlogPost::latest()->take(5)->get();
        $sonKullanicilar = User::latest()->take(5)->get();
        return view('admin.dashboard', compact('istatistikler', 'aylar', 'blogAylik', 'sonBloglar', 'sonKullanicilar'));
    }
} 