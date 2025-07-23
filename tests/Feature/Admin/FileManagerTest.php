<?php
namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Spatie\Permission\Models\Role;

class FileManagerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
        if (!Role::where('name', 'Admin')->exists()) {
            Role::create(['name' => 'Admin']);
        }
    }

    /** @test */
    public function admin_dosya_yukleyebilir()
    {
        $admin = User::factory()->create();
        $admin->assignRole('Admin');
        $file = UploadedFile::fake()->image('test.jpg');
        $response = $this->actingAs($admin)->post(route('admin.filemanager.upload'), [
            'file' => $file,
            'path' => '/',
        ]);
        $response->assertRedirect();
        $uploadedName = glob(Storage::disk('public')->path('/') . '*_test.jpg');
        $this->assertNotEmpty($uploadedName, 'Yüklenen dosya bulunamadı');
        // Türkçe yorum: Admin dosya yükleyebiliyor, uniqid ile isim kontrolü
    }

    /** @test */
    public function admin_klasor_olusturabilir()
    {
        $admin = User::factory()->create();
        $admin->assignRole('Admin');
        $response = $this->actingAs($admin)->post(route('admin.filemanager.createFolder'), [
            'path' => '/',
            'folder' => 'yeni-klasor',
        ]);
        $response->assertRedirect();
        Storage::disk('public')->assertExists('yeni-klasor');
        // Türkçe yorum: Admin yeni klasör oluşturabiliyor
    }

    /** @test */
    public function admin_dosya_silebilir()
    {
        $admin = User::factory()->create();
        $admin->assignRole('Admin');
        $file = UploadedFile::fake()->image('sil.jpg');
        $path = $file->storeAs('/', 'sil.jpg', 'public');
        $this->assertTrue(Storage::disk('public')->exists('sil.jpg'));
        $response = $this->actingAs($admin)->post(route('admin.filemanager.delete'), [
            'file' => 'sil.jpg',
        ]);
        $response->assertRedirect();
        Storage::disk('public')->assertMissing('sil.jpg');
        // Türkçe yorum: Admin dosya silebiliyor
    }

    /** @test */
    public function admin_dosya_yeniden_adlandirabilir()
    {
        $admin = User::factory()->create();
        $admin->assignRole('Admin');
        $file = UploadedFile::fake()->image('eski.jpg');
        $file->storeAs('/', 'eski.jpg', 'public');
        $response = $this->actingAs($admin)->post(route('admin.filemanager.rename'), [
            'old' => 'eski.jpg',
            'new' => 'yeni.jpg',
        ]);
        $response->assertRedirect();
        Storage::disk('public')->assertMissing('eski.jpg');
        Storage::disk('public')->assertExists('yeni.jpg');
        // Türkçe yorum: Admin dosya yeniden adlandırabiliyor
    }

    /** @test */
    public function admin_olmayan_kullanici_erisemez()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('admin.filemanager.index'));
        $response->assertStatus(403);
        // Türkçe yorum: Yetkisiz kullanıcı erişemez
    }
} 