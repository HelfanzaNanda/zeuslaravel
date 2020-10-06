@if(!empty($data))
<div class="row">
    <div class="col-sm-8">
        <a href="javascript:;" onclick="get_access();" class="btn btn-secondary"><i class="fa fa-search"></i> Refresh Module</a>
    </div>
    <div class="col-sm-4">
        <input type="text" id="search" class="form-control " placeholder="Search Data" />
    </div>
</div>
<p>
    <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" id="select_all_modules">
        <label class="form-check-label" for="select_all_modules">Select All Modules</label>
    </div>
    <hr />
    <form method="post" id="frmupdate">
        @csrf
        <input type="hidden" name="id" value="{{ $group_id}}" />
        <div class="row">
            @php
            $i=0;
            @endphp
            @foreach($data as $k=>$v)
            @php
            $i+=1;
            @endphp

            @php
            $module_title=str_replace("/"," ",$k);
            $module_title=ucwords($module_title);
            @endphp
            <div class="col-md-4 module_search" data-title="{{ $module_title }}">
                <div class="card">
                    <div class="card-header module_name">
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input select_all" data-id="{{ $i }}" id="select_all_{{ $i }}">
                            <label class="form-check-label" for="select_all_{{ $i }}"><b>{{ $module_title }}</b></label>
                        </div>
                    </div>
                    <div class="card-body">
                        @foreach($v as $k2=>$v2)
                        <div class="form-group form-check">
                            <input type="checkbox" name="item[{{ $v2->id }}]" class="form-check-input item_{{$i}} item" id="item[{{ $v2->id }}]" {{ ($v2->active?'checked=""':"") }}>
                            <label class="form-check-label" for="item[{{ $v2->id }}]">{{ str_replace("."," ",$v2->sub_module) }}</label>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <button type="submit" class="btn btn-primary">Save Access</button>
    </form>

</p>
@else
Opps!! no apps route here. Please add before
@endif

<script>
    $(document).ready(function() {

        $("#search").on('keyup', function() {
            var txt = $('#search').val();
            $(".module_search").hide();
            $('.module_search').each(function() {
                if ($(this).attr('data-title').toUpperCase().indexOf(txt.toUpperCase()) != -1) {
                    $(this).show();
                }
            });
        });

        $("#select_all_modules").on('change', function() {
            $('.item').prop('checked', this.checked);
        });

        $(".select_all").each(function() {
            $(this).on('change', function() {
                var dataid = $(this).attr('data-id');
                $('.item_' + dataid).prop('checked', this.checked);
            });
        });

        $("#frmupdate").on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                    url: "{{ route('core.config.module_access.update') }}",
                    data: $(this).serialize(),
                    type: "post",
                    dataType: "json",
                    beforeSend: function() {
                        overlay_show();
                    },
                })
                .done(function(x) {
                    if (x.status == true) {
                        get_access();
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

    });
</script>