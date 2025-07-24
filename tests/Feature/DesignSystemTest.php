<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DesignSystemTest extends TestCase
{
    public function test_css_and_js_are_minified_and_compressed()
    {
        $css = public_path('build/assets/app.css');
        $js = public_path('build/assets/app.js');
        $this->assertFileExists($css);
        $this->assertFileExists($js);
        $this->assertFileExists($css . '.gz');
        $this->assertFileExists($js . '.gz');
        $this->assertFileExists($css . '.br');
        $this->assertFileExists($js . '.br');
        // Türkçe: CSS ve JS dosyalarının minify ve gzip/brotli ile sıkıştırılmış halleri var mı kontrol edilir.
    }

    public function test_critical_css_is_included_in_head()
    {
        $response = $this->get('/');
        $response->assertSee('<link rel="preload" as="style"', false);
        $response->assertSee('@vite', false);
        // Türkçe: Kritik CSS preload ve @vite ile head içinde var mı kontrol edilir.
    }
} 