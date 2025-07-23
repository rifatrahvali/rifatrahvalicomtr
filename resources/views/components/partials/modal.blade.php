<div class="modal-overlay" id="modal-overlay" style="display:none;">
    <div class="modal-content" role="dialog" aria-modal="true">
        <button class="modal-close" onclick="document.getElementById('modal-overlay').style.display='none'">&times;</button>
        <div id="modal-body">
            {{ $slot }}
        </div>
    </div>
</div>
<!-- Türkçe: Basit modal bileşeni. Açmak için #modal-overlay'i display:block yapabilirsin. --> 