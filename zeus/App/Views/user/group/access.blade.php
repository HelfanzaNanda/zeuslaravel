<div class="card">
    <div class="card-header">
        Group Info
    </div>
    <div class="card-body">
        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Group Name</label>
            <div class="col-sm-10">
                <p class="form-control-static">{{ $info->meta_value }}</p>
            </div>
        </div>
        <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Group Key</label>
            <div class="col-sm-10">
                <p class="form-control-static">{{ $info->meta_key }}</p>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header">
        Modules
    </div>
    <div class="card-body">
        <div id="respon"></div>
    </div>
</div>

@push('assets')
<script>
    $(document).ready(function() {

        setTimeout(() => {
            show_modules();
        }, 500);

    });

    function show_modules() {
        $.ajax({
                url: "{{ route('core.user.group.show_modules') }}",
                data: "group={{ $info->id }}",
                type: "GET",
                dataType: "html",
                beforeSend: function() {
                    $("#respon").html('Loading');
                },
            })
            .done(function(x) {
                $("#respon").html(x);
            })
            .fail(function() {
                $("#respon").html('Server not respond');
            })
            .always(function() {

            });

    }
</script>
@endpush