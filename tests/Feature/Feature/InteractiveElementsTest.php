<?php

namespace Tests\Feature;

use Tests\TestCase;

class InteractiveElementsTest extends TestCase
{
    /** @test */
    public function animasyon_classlari_render_edilir()
    {
        $html = view('welcome', [])->render();
        $this->assertStringContainsString('animate-fade-in', $html);
        $this->assertStringContainsString('animate-slide-up', $html);
        // Türkçe: Animasyon class'larının sayfada render edilip edilmediği kontrol edilir
    }

    /** @test */
    public function loading_spinner_component_render_edilir()
    {
        $html = view('components.partials.loading')->render();
        $this->assertStringContainsString('loading-spinner', $html);
        $this->assertStringContainsString('spinner', $html);
        // Türkçe: Loading spinner bileşeninin doğru şekilde render edilip edilmediği kontrol edilir
    }

    /** @test */
    public function modal_component_render_edilir()
    {
        $html = view('components.partials.modal', ['slot' => 'Modal İçerik'])->render();
        $this->assertStringContainsString('modal-overlay', $html);
        $this->assertStringContainsString('modal-content', $html);
        // Türkçe: Modal bileşeninin doğru şekilde render edilip edilmediği kontrol edilir
    }

    /** @test */
    public function tooltip_component_render_edilir()
    {
        $html = view('components.partials.tooltip', ['slot' => 'Hover', 'text' => 'Açıklama'])->render();
        $this->assertStringContainsString('tooltip-container', $html);
        $this->assertStringContainsString('tooltip-text', $html);
        // Türkçe: Tooltip bileşeninin doğru şekilde render edilip edilmediği kontrol edilir
    }
}
