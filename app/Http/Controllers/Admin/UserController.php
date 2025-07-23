<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\ActivityLog;

class UserController extends Controller
{
    /**
     * Yeni kullanıcı ekleme formu.
     */
    public function create()
    {
        // Türkçe yorum: Tüm roller çekiliyor
        $roller = Role::all();
        return view('admin.users.create', compact('roller'));
    }

    /**
     * Kullanıcıyı kaydeder.
     */
    public function store(StoreUserRequest $request)
    {
        // Türkçe yorum: Formdan gelen veriler validasyon sonrası alınır
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        $user->syncRoles($request->input('roles', []));
        // Türkçe yorum: Kullanıcı oluşturulduktan sonra rol atanır
        ActivityLog::log(
            'user_create',
            'Admin yeni kullanıcı oluşturdu: ' . $user->email,
            auth()->id(),
            $request->ip(),
            $request->userAgent()
        );
        // Türkçe: Kullanıcı oluşturma işlemi ActivityLog ile kaydedildi
        return redirect()->route('admin.users.index')->with('success', 'Kullanıcı başarıyla eklendi.');
    }

    /**
     * Kullanıcı düzenleme formu.
     */
    public function edit(User $user)
    {
        $roller = Role::all();
        $userRoles = $user->roles->pluck('name')->toArray();
        return view('admin.users.edit', compact('user', 'roller', 'userRoles'));
    }

    /**
     * Kullanıcıyı günceller.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->validated();
        if ($request->filled('password')) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
        $user->update($data);
        $user->syncRoles($request->input('roles', []));
        // Türkçe yorum: Kullanıcı güncellendi ve rol ataması yapıldı
        ActivityLog::log(
            'user_update',
            'Admin kullanıcıyı güncelledi: ' . $user->email,
            auth()->id(),
            $request->ip(),
            $request->userAgent()
        );
        // Türkçe: Kullanıcı güncelleme işlemi ActivityLog ile kaydedildi
        return redirect()->route('admin.users.index')->with('success', 'Kullanıcı güncellendi.');
    }

    /**
     * Kullanıcıyı siler.
     */
    public function destroy(User $user)
    {
        $userId = $user->id;
        $userEmail = $user->email;
        $user->delete();
        ActivityLog::log(
            'user_delete',
            'Admin kullanıcı sildi: ' . $userEmail,
            auth()->id(),
            request()->ip(),
            request()->userAgent()
        );
        // Türkçe: Kullanıcı silme işlemi ActivityLog ile kaydedildi
        return redirect()->route('admin.users.index')->with('success', 'Kullanıcı silindi.');
    }

    /**
     * Kullanıcıları listeler.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Türkçe yorum: Kullanıcılar sayfalı olarak çekiliyor
        $kullanicilar = User::with('roles')->paginate(15);
        return view('admin.users.index', compact('kullanicilar'));
    }
} 