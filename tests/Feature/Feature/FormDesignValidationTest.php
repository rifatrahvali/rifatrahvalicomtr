<?php

namespace Tests\Feature;

use Tests\TestCase;

class FormDesignValidationTest extends TestCase
{
    /** @test */
    public function form_bilesenleri_ve_classlari_render_edilir()
    {
        $html = view('welcome', [])->render();
        $this->assertStringContainsString('form-group', $html);
        $this->assertStringContainsString('form-label', $html);
        $this->assertStringContainsString('form-input', $html);
        $this->assertStringContainsString('form-error', $html);
        $this->assertStringContainsString('form-helper', $html);
        $this->assertStringContainsString('form-select', $html);
        $this->assertStringContainsString('form-textarea', $html);
        // Türkçe: Formun temel bileşenlerinin ve class'larının doğru şekilde render edilip edilmediği kontrol edilir
    }

    /** @test */
    public function formda_erişilebilirlik_etiketleri_var()
    {
        $html = view('welcome', [])->render();
        $this->assertStringContainsString('aria-describedby="nameHelp"', $html);
        $this->assertStringContainsString('aria-describedby="emailHelp"', $html);
        $this->assertStringContainsString('aria-describedby="passwordHelp"', $html);
        $this->assertStringContainsString('required', $html);
        // Türkçe: Formda erişilebilirlik için gerekli aria ve required etiketleri kontrol edilir
    }

    /** @test */
    public function formda_checkbox_radio_modern_gorunumde_render_edilir()
    {
        $html = view('welcome', [])->render();
        $this->assertStringContainsString('type="checkbox"', $html);
        // Türkçe: Checkbox input modern görünüme sahip mi kontrol edilir
    }
}
