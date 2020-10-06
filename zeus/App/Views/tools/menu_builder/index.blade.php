@push('assets')
@php
echo cdn_select2();
echo cdn_jqueryui();
@endphp
<script src="{{ asset('/assets/js/sortable.js') }}"></script>
@endpush

<div class="row">
    <div class="col-md-5">
        <div class="card">
            <div class="card-header">Add Menu</div>
            <div class="card-body">
                <form method="post" id="frmadd">
                    @csrf
                    <div class="form-group">
                        <label>Menu Title</label>
                        <input type="text" name="title" id="title" class="form-control input-add" placeholder="Menu Title" required value="" />
                    </div>
                    <div class="form-group">
                        <label>Menu Parent</label>
                        <select name="parent" id="parent" class="form-control " style="width:100%" data-placeholder="Choose Menu" data-allow-clear="true">
                            <option></option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>URL Segment <small>domain.com/<b>First Segment</b>/<b>Second Segment</b>/<b>Third Segment</b></small></label>
                        <input type="text" name="segment[0]" id="segment1" class="form-control segment input-add" placeholder="First Segment (Required)" required value="" />
                        <input type="text" name="segment[1]" class="form-control segment input-add" placeholder="Second Segment (Optional)" value="" />
                        <input type="text" name="segment[2]" class="form-control segment input-add" placeholder="Third Segment (Optional)" value="" />
                    </div>
                    <div class="form-group">
                        <label>Icon</label>
                        <input type="text" name="icon" class="form-control " placeholder="Menu Icon" required value="fa fa-circle" />
                    </div>

                    <div class="form-group">
                        <label>Route Name</label>
                        <input type="text" name="route" id="route" class="form-control input-add" placeholder="Menu Route Name" value="" />
                    </div>
                    <div class="form-group">
                        <label>&nbsp;</label>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="checkbox">
            <label>
                <input type="checkbox" id="menu_admin" /> Show System menu
            </label>
        </div>
        <div id="response"></div>
    </div>
</div>



@push('assets')
<script>
    $(document).ready(function() {
        $("#route").val("");
        show_menu();
        $("#frmadd").on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                    url: "{{ route('core.tools.menu_builder.store') }}",
                    data: $(this).serialize(),
                    type: "post",
                    dataType: "json",
                    beforeSend: function() {
                        overlay_show();
                    },
                })
                .done(function(x) {
                    if (x.status == true) {
                        $(".input-add").val("");
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

        $("#parent").select2({
            allowClear: true,
            ajax: {
                url: "{{ route('core.tools.menu_builder.menu_parent') }}",
                dataType: 'json',
                delay: 0,
                data: function(params) {
                    return {
                        q: params.term,
                        menu_admin: $("#menu_admin").is(':checked')
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

        $("#parent").on('change', function() {
            var p = $(this).val();
            if (p != '') {
                $(".segment").prop('disabled', true);
                $(".segment").val("");
                $("#segment1").prop('required', false);
            } else {
                $(".segment").prop('disabled', false);
                $(".segment").val("");
                $("#segment1").prop('required', true);
            }
        });

        $("#menu_admin").on('change', function() {
            show_menu();
        });

    });

    function show_menu() {
        var admin_show = 0;
        if ($("#menu_admin").is(':checked')) {
            admin_show = 1;
        }
        $.ajax({
                url: "{{ route('core.tools.menu_builder.menu_get') }}?admin_show=" + admin_show,
                data: "",
                type: "get",
                dataType: "html",
                beforeSend: function() {
                    $("#response").html('loading');
                },
            })
            .done(function(x) {
                $("#response").html(x);
            })
            .fail(function() {
                $("#response").html('Server not respond');
            })
            .always(function() {

            });

    }
</script>
@endpush