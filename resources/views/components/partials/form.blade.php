<form {{ $attributes->merge(['class' => 'form']) }} novalidate>
    @csrf
    {{ $slot }}
</form>
<!-- Türkçe: Erişilebilir, reusable form bileşeni. Slot ile içerik dinamik olarak eklenir. --> 