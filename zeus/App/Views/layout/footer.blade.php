<div class="m-overlay" style="display: none;">
    <div class="overlay-loading-container">
        <div class="overlay-loading-item overlay-loading-item-1"></div>
        <div class="overlay-loading-item overlay-loading-item-2"></div>
        <div class="overlay-loading-item overlay-loading-item-3"></div>
        <div class="overlay-loading-item overlay-loading-item-4"></div>
    </div>
</div>
@php
echo add_js(asset('assets/js/script.js'));
@endphp
@stack('assets')