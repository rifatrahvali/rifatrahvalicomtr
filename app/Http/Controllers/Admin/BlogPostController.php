<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{
    /**
     * Yeni blog yazısı ekleme formunu gösterir.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Türkçe yorum: Blog yazısı ekleme formu (şimdilik basit bir placeholder)
        return view('admin.blog.create');
    }
} 