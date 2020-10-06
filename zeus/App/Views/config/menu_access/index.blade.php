@push('assets')
@php
echo cdn_select2();
@endphp
@endpush('assets')

<div class="form-horizontal">
    <div class="form-group ">
        <label class="control-label col-sm-2">User Group</label>
        <div class="col-md-7">
            <select name="group" id="group" class="form-control select2" style="width:100%" data-placeholder="Choose User Group" data-allow-clear="true">
                <option></option>
                @if(!empty($user_group))
                @foreach($user_group as $g)
                @if($g->meta_key != 'superadmin')
                <option value="{{ $g->id }}">{{ $g->meta_value}}</option>
                @endif
                @endforeach
                @endif
            </select>
        </div>
    </div>
</div>

<div class="clearfix"></div>
<hr />
<div id="response"></div>

@push('assets')
<script>
    $(document).ready(function() {

        $(".select2").select2();
        $("#group").on('change', function() {
            get_access();
        });

    });

    function get_access() {
        var group = $("#group").val();
        if (typeof group == "undefined") {
            return false;
        }
        $.ajax({
                url: "{{ route('core.config.menu_access.get_access') }}",
                data: "id=" + group,
                type: "get",
                dataType: "html",
                beforeSend: function() {
                    $("#response").html('Loading');
                    overlay_show();
                },
            })
            .done(function(x) {
                $("#response").html(x);
                overlay_hide();
            })
            .fail(function() {
                $("#response").html('Server not respond');
                overlay_hide();
            })
            .always(function() {

            });

    }
</script>
@endpush('assets')