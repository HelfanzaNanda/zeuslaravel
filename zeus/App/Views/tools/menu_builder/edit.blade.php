@php
$segment=json_decode($data->segment);
$segment_1=isset($segment[0])?$segment[0]:"";
$segment_2=isset($segment[1])?$segment[1]:"";
$segment_3=isset($segment[1])?$segment[2]:"";
@endphp
<form method="post" id="frmedit">
    @csrf
    <input type="hidden" name="id" value="{{ $data->id }}" />
    <div class="form-group">
        <label>Menu Title</label>
        <input type="text" name="title" class="form-control" placeholder="Menu Title" required value="{{ $data->title }}" />
    </div>
    @if(empty($data->zeus_menu_id))
    <div class="form-group">
        <label>URL Segment <small>domain.com/<b>First Segment</b>/<b>Second Segment</b>/<b>Third Segment</b></small></label>
        <input type="text" name="segment[0]" id="segment11" class="form-control segment2" placeholder="First Segment (Required)" required value="{{ $segment_1 }}" />
        <input type="text" name="segment[1]" class="form-control segment2" placeholder="Second Segment (Optional)" value="{{ $segment_2 }}" />
        <input type="text" name="segment[2]" class="form-control segment2" placeholder="Third Segment (Optional)" value="{{ $segment_3 }}" />
    </div>
    @endif
    <div class="form-group">
        <label>Icon</label>
        <input type="text" name="icon" class="form-control " placeholder="Menu Icon" required value="{{ $data->icon }}" />
    </div>

    <div class="form-group">
        <label>Route Name</label>
        <input type="text" name="route" id="route2" class="form-control" placeholder="Menu Route Name" value="{{ $data->route_name }}" />
    </div>
    <div class="form-group">
        <label>User Group Access</label>
        @foreach($access_menu as $g)
        @php
        $chk='';
        if($g['chk']==1)
        {
        $chk='checked=""';
        }
        @endphp
        <div class="checkbox">
            <label>
                <input type="checkbox" name="group[]" <?= $chk; ?> value="{{ $g['id'] }}" /> {{ $g['meta_value'] }}
            </label>
        </div>
        @endforeach
    </div>
    <div class="form-group">
        <label>&nbsp;</label>
        <button type="submit" class="btn btn-primary">Save</button>
    </div>

</form>

<script>
    $(document).ready(function() {
        $("#frmedit").on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                    url: "{{ route('core.tools.menu_builder.menu_edit') }}",
                    data: $(this).serialize(),
                    type: "post",
                    dataType: "json",
                    beforeSend: function() {
                        $("#modaledit").modal('hide');
                        overlay_show();
                    },
                })
                .done(function(x) {
                    if (x.status == true) {
                        show_menu();
                        alert(x.message);
                    } else {
                        alert(x.message);
                    }
                    overlay_hide();
                })
                .fail(function() {
                    alert('Server not respond');
                    overlay_hide();
                })
                .always(function() {

                });
        });
        $("#parent2").select2({
            allowClear: true,
            ajax: {
                url: "{{ route('core.tools.menu_builder.menu_parent') }}",
                dataType: 'json',
                delay: 0,
                data: function(params) {
                    return {
                        q: params.term,
                    };
                },
                processResults: function(data, params) {
                    params.page = params.page || 1;
                    return {
                        results: $.map(data, function(obj) {
                            return {
                                id: obj.id,
                                text: obj.title
                            };
                        }),
                    };
                },
                cache: true
            },
        });

        $("#parent2").on('change', function() {
            var p = $(this).val();
            if (p != '') {
                $(".segment2").prop('disabled', true);
                $(".segment2").val("");
                $("#segment11").prop('required', false);
            } else {
                $(".segment2").prop('disabled', false);
                $(".segment2").val("");
                $("#segment11").prop('required', true);
            }
        });

    });
</script>