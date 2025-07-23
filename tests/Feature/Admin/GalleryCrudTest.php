<?php

namespace Tests\Feature\Admin;

use App\Models\Gallery;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class GalleryCrudTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        if (!Role::where('name', 'Admin')->exists()) {
            Role::create(['name' => 'Admin']);
        }
        if (!Role::where('name', 'User')->exists()) {
            Role::create(['name' => 'User']);
        }
        if (!Permission::where('name', 'manage-galleries')->exists()) {
            Permission::create(['name' => 'manage-galleries']);
        }
        // Türkçe yorum: Test ortamında Admin ve User rolleri ile manage-galleries izni programatik olarak oluşturuluyor.
    }

    public function test_admin_can_create_gallery_item()
    {
        Storage::fake('public');
        $admin = User::factory()->create();
        $admin->assignRole('Admin');
        $admin->givePermissionTo('manage-galleries');
        $file = UploadedFile::fake()->image('test.jpg');
        $response = $this->actingAs($admin)->post(route('admin.gallery.store'), [
            'title' => 'Test Görseli',
            'description' => 'Açıklama',
            'file' => $file,
            'type' => 'image',
            'order' => 1,
        ]);
        $response->assertRedirect(route('admin.gallery.index'));
        $this->assertDatabaseHas('galleries', ['title' => 'Test Görseli']);
        // Türkçe yorum: Admin yeni galeri öğesi ekleyebilir.
    }

    public function test_admin_can_update_gallery_item()
    {
        Storage::fake('public');
        $admin = User::factory()->create();
        $admin->assignRole('Admin');
        $admin->givePermissionTo('manage-galleries');
        $gallery = Gallery::factory()->create();
        $file = UploadedFile::fake()->image('update.jpg');
        $response = $this->actingAs($admin)->put(route('admin.gallery.update', $gallery), [
            'title' => 'Güncellenmiş Başlık',
            'description' => 'Yeni açıklama',
            'file' => $file,
            'type' => 'image',
            'order' => 2,
        ]);
        $response->assertRedirect(route('admin.gallery.index'));
        $this->assertDatabaseHas('galleries', ['title' => 'Güncellenmiş Başlık']);
        // Türkçe yorum: Admin galeri öğesini güncelleyebilir.
    }

    public function test_admin_can_delete_gallery_item()
    {
        $admin = User::factory()->create();
        $admin->assignRole('Admin');
        $gallery = Gallery::factory()->create();
        $response = $this->actingAs($admin)->delete(route('admin.gallery.destroy', $gallery));
        $response->assertRedirect(route('admin.gallery.index'));
        $this->assertDatabaseMissing('galleries', ['id' => $gallery->id]);
        // Türkçe yorum: Admin galeri öğesini silebilir.
    }

    public function test_admin_can_bulk_upload_gallery_items()
    {
        Storage::fake('public');
        $admin = User::factory()->create();
        $admin->assignRole('Admin');
        $files = [
            UploadedFile::fake()->image('bulk1.jpg'),
            UploadedFile::fake()->image('bulk2.jpg'),
        ];
        $response = $this->actingAs($admin)->post(route('admin.gallery.bulk-upload'), [
            'files' => $files,
        ]);
        $response->assertRedirect(route('admin.gallery.index'));
        $this->assertDatabaseCount('galleries', 2);
        // Türkçe yorum: Admin birden fazla dosyayı toplu yükleyebilir.
    }

    public function test_non_admin_cannot_access_gallery_routes()
    {
        $user = User::factory()->create();
        $user->assignRole('User');
        $response = $this->actingAs($user)->get(route('admin.gallery.index'));
        $response->assertStatus(403);
        // Türkçe yorum: Admin olmayan kullanıcı galeri yönetimine erişemez.
    }
} 