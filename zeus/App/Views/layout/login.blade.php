@php
$admin_template=config_read('admin_template');
@endphp
@include('themes.'.$admin_template.'.login')