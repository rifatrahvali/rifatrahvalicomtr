<?php

namespace Tests\Unit;

use App\Models\BlogCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BlogCategoryModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function blog_category_fillable_fields_are_assignable()
    {
        $cat = BlogCategory::factory()->make([
            'name' => 'Kategori',
            'slug' => 'kategori',
            'parent_id' => null,
        ]);
        $this->assertEquals('Kategori', $cat->name);
        $this->assertEquals('kategori', $cat->slug);
        $this->assertNull($cat->parent_id);
        // Türkçe: Fillable alanlar doğru şekilde atanabiliyor mu kontrol edilir.
    }

    /** @test */
    public function blog_category_parent_relationship_works()
    {
        $parent = BlogCategory::factory()->create();
        $child = BlogCategory::factory()->create(['parent_id' => $parent->id]);
        $this->assertTrue($child->parent->is($parent));
        // Türkçe: Alt kategori ile üst kategori ilişkisi doğru çalışıyor mu kontrol edilir.
    }

    /** @test */
    public function blog_category_children_relationship_works()
    {
        $parent = BlogCategory::factory()->create();
        $child1 = BlogCategory::factory()->create(['parent_id' => $parent->id]);
        $child2 = BlogCategory::factory()->create(['parent_id' => $parent->id]);
        $this->assertTrue($parent->children->contains($child1));
        $this->assertTrue($parent->children->contains($child2));
        // Türkçe: Üst kategori ile alt kategoriler ilişkisi doğru çalışıyor mu kontrol edilir.
    }
} 