<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ActivityLog;

class ActivityLogController extends Controller
{
    public function __construct()
    {
        // Sadece admin rolüne sahip kullanıcılar erişebilir
        $this->middleware(['auth', 'role:admin']);
    }

    /**
     * Tüm logları listeler
     */
    public function index()
    {
        // Türkçe: Logları en yeniye göre çekiyoruz
        $logs = ActivityLog::with('user')->orderByDesc('created_at')->paginate(30);
        return view('admin.activity.index', compact('logs'));
    }
}
