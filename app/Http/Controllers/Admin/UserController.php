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
     * Toplu işlem (silme, rol atama, yayından kaldırma) fonksiyonu
     */
    public function bulkAction(Request $request)
    {
        // Türkçe: Seçili kullanıcı id'leri alınır
        $ids = $request->input('ids', []);
        $action = $request->input('action');
        if (!is_array($ids) || empty($ids)) {
            return response()->json(['message' => 'Hiçbir kullanıcı seçilmedi.'], 422);
        }
        if ($action === 'delete') {
            // Türkçe: Seçili kullanıcılar silinir
            $deleted = User::whereIn('id', $ids)->delete();
            return response()->json(['message' => "$deleted kullanıcı silindi."]);
        } elseif ($action === 'set_role' && $request->has('role')) {
            // Türkçe: Seçili kullanıcılara rol atanır
            $role = $request->input('role');
            $users = User::whereIn('id', $ids)->get();
            foreach ($users as $user) {
                $user->syncRoles([$role]);
            }
            return response()->json(['message' => 'Seçili kullanıcılara rol atandı.']);
        }
        // Türkçe: Geçersiz işlem
        return response()->json(['message' => 'Geçersiz işlem.'], 422);
    }

    /**
     * Kullanıcıları listeler.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Türkçe: Kullanıcılar sorgusu başlatılır
        $query = User::query()->with('roles');
        // Türkçe: İsim araması
        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        // Türkçe: E-posta araması
        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }
        // Türkçe: Rol filtresi (çoklu seçim)
        if ($request->filled('role')) {
            $roles = (array) $request->role;
            $query->whereHas('roles', function ($q) use ($roles) {
                $q->whereIn('name', $roles);
            });
        }
        // Türkçe: Durum filtresi (aktif/pasif)
        if ($request->filled('status')) {
            if ($request->status === 'active') {
                // Türkçe: Sadece aktif kullanıcılar (varsayılan davranış)
                // Soft delete ile silinmemiş olanlar
            } elseif ($request->status === 'passive') {
                // Türkçe: Sadece silinmiş (pasif) kullanıcılar
                $query->onlyTrashed();
            }
        }
        // Türkçe: Sonuçları sayfalı olarak döndür
        $kullanicilar = $query->paginate(15)->appends($request->except('page'));
        $roller = \Spatie\Permission\Models\Role::all();
        return view('admin.users.index', compact('kullanicilar', 'roller'));
    }
} 