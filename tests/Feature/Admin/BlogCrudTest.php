<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use App\Models\BlogPost;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Spatie\Permission\Models\Role;
use App\Models\BlogCategory;

class BlogCrudTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Role::firstOrCreate(['name' => 'admin']);
        // Türkçe yorum: Test başlamadan önce admin rolü veritabanında yoksa oluşturulur.
        $this->category = BlogCategory::factory()->create();
        // Türkçe yorum: Testlerde kullanılacak bir blog kategorisi oluşturulur.
    }

    /** @test */
    public function admin_blog_yazisi_ekleyebilir()
    {
        $user = User::factory()->create();
        $user->assignRole('admin'); // Türkçe yorum: Test kullanıcısına admin rolü atanıyor.
        $this->actingAs($user);
        $data = [
            'title' => 'Test Blog',
            'content' => 'Test içerik',
            'status' => 'draft',
            'blog_category_id' => $this->category->id,
        ];
        $response = $this->post(route('admin.blog.store'), $data);
        $response->assertRedirect(route('admin.blog.index'));
        $this->assertDatabaseHas('blog_posts', ['title' => 'Test Blog']);
        // Türkçe yorum: Admin kullanıcı blog yazısı ekleyebilir ve veritabanında kayıt oluşur.
    }

    /** @test */
    public function admin_blog_yazilarini_listeleyebilir()
    {
        $user = User::factory()->create();
        $user->assignRole('admin'); // Türkçe yorum: Test kullanıcısına admin rolü atanıyor.
        $this->actingAs($user);
        BlogPost::factory()->count(2)->create(['user_id' => $user->id]);
        $response = $this->get(route('admin.blog.index'));
        $response->assertStatus(200);
        $response->assertSee('Blog Yazıları');
        // Türkçe yorum: Blog yazıları listelenebiliyor ve sayfa başarılı şekilde açılıyor.
    }

    /** @test */
    public function admin_blog_yazisi_guncelleyebilir()
    {
        $user = User::factory()->create();
        $user->assignRole('admin'); // Türkçe yorum: Test kullanıcısına admin rolü atanıyor.
        $this->actingAs($user);
        $post = BlogPost::factory()->create(['user_id' => $user->id, 'title' => 'Eski Başlık', 'blog_category_id' => $this->category->id]);
        $data = [
            'title' => 'Yeni Başlık',
            'content' => $post->content,
            'status' => $post->status,
            'blog_category_id' => $this->category->id,
        ];
        $response = $this->put(route('admin.blog.update', $post->id), $data);
        $response->assertRedirect(route('admin.blog.index'));
        $this->assertDatabaseHas('blog_posts', ['title' => 'Yeni Başlık']);
        // Türkçe yorum: Blog yazısı güncellenebilir ve yeni başlık veritabanında görünür.
    }

    /** @test */
    public function admin_blog_yazisi_silebilir()
    {
        $user = User::factory()->create();
        $user->assignRole('admin'); // Türkçe yorum: Test kullanıcısına admin rolü atanıyor.
        $this->actingAs($user);
        $post = BlogPost::factory()->create(['user_id' => $user->id]);
        $response = $this->delete(route('admin.blog.destroy', $post->id));
        $response->assertRedirect(route('admin.blog.index'));
        $this->assertDatabaseMissing('blog_posts', ['id' => $post->id]);
        // Türkçe yorum: Blog yazısı silindiğinde veritabanında artık bulunmaz.
    }
} 