@php
echo add_js(asset('assets/js/script.js'));
echo add_js(asset('assets/js/notif.js'));
@endphp
@stack('assets')
<div class="m-overlay" style="display: none;">
    <div class="overlay-loading-container">
        <div class="overlay-loading-item overlay-loading-item-1"></div>
        <div class="overlay-loading-item overlay-loading-item-2"></div>
        <div class="overlay-loading-item overlay-loading-item-3"></div>
        <div class="overlay-loading-item overlay-loading-item-4"></div>
    </div>
</div>
<div class="toast" id="zeus_alert">
    <div class="toast-header" id="zeus_alert_header">
    </div>
    <div class="toast-body" id="zeus_alert_message">
    </div>
</div>