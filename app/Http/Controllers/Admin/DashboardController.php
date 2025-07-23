<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Admin paneli ana sayfasını gösterir.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Türkçe yorum: Admin paneli ana sayfa görünümünü döndürür
        return view('admin.dashboard');
    }
} 