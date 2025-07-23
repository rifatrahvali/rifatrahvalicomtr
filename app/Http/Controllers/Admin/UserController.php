<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Yeni kullanıcı ekleme formunu gösterir.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Türkçe yorum: Kullanıcı ekleme formu (şimdilik basit bir placeholder)
        return view('admin.users.create');
    }
} 