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
        Log::info('Admin kullanıcı oluşturdu', ['admin_id' => auth()->id(), 'user_id' => $user->id]);
        // Türkçe yorum: Kullanıcı oluşturma işlemi loglandı
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
        Log::info('Admin kullanıcı güncelledi', ['admin_id' => auth()->id(), 'user_id' => $user->id]);
        // Türkçe yorum: Kullanıcı güncelleme işlemi loglandı
        return redirect()->route('admin.users.index')->with('success', 'Kullanıcı güncellendi.');
    }

    /**
     * Kullanıcıyı siler.
     */
    public function destroy(User $user)
    {
        $userId = $user->id;
        $user->delete();
        Log::info('Admin kullanıcı sildi', ['admin_id' => auth()->id(), 'user_id' => $userId]);
        // Türkçe yorum: Kullanıcı silme işlemi loglandı
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