<?php

namespace Tests\Feature\Admin;

use App\Models\Reference;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class ReferenceCrudTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        if (!Role::where('name', 'Admin')->exists()) {
            Role::create(['name' => 'Admin']);
        }
        if (!Permission::where('name', 'manage-references')->exists()) {
            Permission::create(['name' => 'manage-references']);
        }
    }

    public function test_admin_can_create_reference_with_images()
    {
        Storage::fake('public');
        $admin = User::factory()->create();
        $admin->assignRole('Admin');
        $admin->givePermissionTo('manage-references');
        $file1 = UploadedFile::fake()->image('test1.jpg');
        $file2 = UploadedFile::fake()->image('test2.jpg');
        $response = $this->actingAs($admin)->post(route('admin.reference.store'), [
            'name' => 'Test Referans',
            'company_name' => 'Test Şirket',
            'position' => 'Yönetici',
            'images' => [$file1, $file2],
            'website_url' => 'https://example.com',
            'description' => 'Açıklama',
            'order_index' => 1,
            'is_active' => true,
        ]);
        $response->assertRedirect(route('admin.reference.index'));
        $this->assertDatabaseHas('references', ['name' => 'Test Referans']);
        // Türkçe yorum: Admin, çoklu görsel ile referans ekleyebiliyor mu?
    }

    public function test_admin_can_update_reference()
    {
        $admin = User::factory()->create();
        $admin->assignRole('Admin');
        $admin->givePermissionTo('manage-references');
        $reference = Reference::factory()->create(['name' => 'Eski Ad']);
        $response = $this->actingAs($admin)->put(route('admin.reference.update', $reference), [
            'name' => 'Yeni Ad',
            'company_name' => $reference->company_name,
            'position' => $reference->position,
            'website_url' => $reference->website_url,
            'description' => $reference->description,
            'order_index' => $reference->order_index,
            'is_active' => true,
        ]);
        $response->assertRedirect(route('admin.reference.index'));
        $this->assertDatabaseHas('references', ['name' => 'Yeni Ad']);
        // Türkçe yorum: Admin, referans güncelleyebiliyor mu?
    }

    public function test_admin_can_delete_reference()
    {
        $admin = User::factory()->create();
        $admin->assignRole('Admin');
        $admin->givePermissionTo('manage-references');
        $reference = Reference::factory()->create();
        $response = $this->actingAs($admin)->delete(route('admin.reference.destroy', $reference));
        $response->assertRedirect(route('admin.reference.index'));
        $this->assertDatabaseMissing('references', ['id' => $reference->id]);
        // Türkçe yorum: Admin, referans silebiliyor mu?
    }

    public function test_user_without_permission_cannot_access_reference_crud()
    {
        $user = User::factory()->create();
        $reference = Reference::factory()->create();
        $response = $this->actingAs($user)->get(route('admin.reference.index'));
        $response->assertForbidden();
        // Türkçe yorum: Yetkisiz kullanıcı referans yönetimine erişemez.
    }
} 