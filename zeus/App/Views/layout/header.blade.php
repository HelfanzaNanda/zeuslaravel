@php
echo add_css(asset('assets/css/style.css'));
echo add_css(asset('assets/css/notif.css'));
@endphp
<link rel="shortcut icon" href="{{ zeus_favicon() }}" />
<script>
    var base_url = "{{ url('/') }}";
</script>