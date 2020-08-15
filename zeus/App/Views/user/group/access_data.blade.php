<div class="row">
    <div class="col-sm-8">
        <a href="javascript:;" onclick="show_modules();" class="btn btn-default"><i class="fa fa-search"></i> Refresh Module</a>
        <a href="{{ route('core.user.group') }}" class="btn btn-default">Back</a>
    </div>
    <div class="col-sm-4">
        <input type="text" id="search" class="form-control " placeholder="Search Data" />
    </div>
</div>
<p>
    @if(!empty($array_modules))
    <div class="checkbox">
        <label>
            <input type="checkbox" id="select_all_modules" /> Select All Modules
        </label>
    </div><hr/>
    <form method="post" id="frmupdate">
        @csrf
        <input type="hidden" name="id" value="{{ $user_group_id}}" />
        <div class="row">
            @php
            $i=0;
            @endphp
            @foreach($array_modules as $k=>$v)
            @php
            $i+=1;
            @endphp
            @if(empty($k))
            <div class="col-md-4 module_search" data-title="">
                <div class="card">
                    <div class="card-header">
                        No Prefix
                    </div>
                    <div class="card-body">
                        @foreach($v as $k2=>$v2)
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="item[{{ $v2['name'] }}]" class="item" {{ ($v2['access']?'checked=""':"") }} /> {{ $v2['label'] }}
                                <button type="button" class="btn btn-link" data-container="body" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="{{ $v2['controller'] }}"><i class="fa fa-info-circle"></i></button>
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @else

            @php
            $module_title=str_replace("/"," ",$k);
            $module_title=ucwords($module_title);
            @endphp
            <div class="col-md-4 module_search" data-title="{{ $module_title }}">
                <div class="card">
                    <div class="card-header module_name">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" class="select_all" data-id="{{ $i }}" /> {{ $module_title }}
                            </label>
                        </div>
                    </div>
                    <div class="card-body">
                        @foreach($v as $k2=>$v2)
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="item[{{ $v2['name'] }}]" class="item_{{$i}} item" {{ ($v2['access']?'checked=""':"") }} /> {{ str_replace("."," ",$v2['name']) }}
                                <button type="button" class="btn btn-link" data-container="body" data-toggle="popover" data-placement="top" data-trigger="hover" data-content="{{ $v2['controller'] }}"><i class="fa fa-info-circle"></i></button>
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
        <button type="submit" class="btn btn-primary">Save Access</button>
    </form>
    @endif
</p>

<script>
    $(document).ready(function() {

        $('[data-toggle="popover"]').popover();

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
                    url: "{{ route('core.user.group.save_access') }}",
                    data: $(this).serialize(),
                    type: "post",
                    dataType: "json",
                    beforeSend: function() {
                        overlay_show();
                    },
                })
                .done(function(x) {
                    if (x.status == true) {
                        show_modules();
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