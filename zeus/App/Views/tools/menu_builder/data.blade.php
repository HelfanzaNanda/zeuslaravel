@if(!empty($data))
<ol class="sortable">
    @foreach($data as $k=>$v)
    @if(empty($v['child']))
    <ol></ol>
    <li id="menuItem__{{ $v['menu_id'] }}" class="mjs-nestedSortable-branch mjs-nestedSortable-expanded">
        <div>
            <h4>
                <div class="menu-title">
                    {{ $k }}
                    @if($v['is_admin'] == 0)
                    <div class="menu-title-anchor">
                        <a href="javascript:;" onclick="show_edit(<?= $v['menu_id']; ?>);" class="btn btn-default btn-xs btn-flat">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a href="javascript:;" onclick="show_delete(<?= $v['menu_id']; ?>);" class="btn btn-danger btn-xs btn-flat">
                            <i class="fa fa-trash"></i>
                        </a>
                    </div>
                    @endif
                </div>
            </h4>
        </div>
    </li>
    @else

    <li id="menuItem__{{ $v['menu_id'] }}" class="mjs-nestedSortable-branch mjs-nestedSortable-expanded">
        <div>
            <h4>
                <div class="menu-title">
                    {{ $k }}
                    @if($v['is_admin'] == 0)
                    <div class="menu-title-anchor">
                        <a href="javascript:;" onclick="show_edit(<?= $v['menu_id']; ?>);" class="btn btn-default btn-xs btn-flat">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a href="javascript:;" onclick="show_delete(<?= $v['menu_id']; ?>);" class="btn btn-danger btn-xs btn-flat">
                            <i class="fa fa-trash"></i>
                        </a>
                    </div>
                    @endif
                </div>
            </h4>
        </div>
        <ol>
            @foreach($v['child'] as $k2=>$v2)
            <li id="menuItem__{{ $v2['menu_id'] }}" class="mjs-nestedSortable-branch mjs-nestedSortable-expanded">
                <div>
                    <h4>
                        <div class="menu-title">
                            {{ $k2 }}
                            @if($v2['is_admin'] == 0)
                            <div class="menu-title-anchor">
                                <a href="javascript:;" onclick="show_edit(<?= $v2['menu_id']; ?>);" class="btn btn-default btn-xs btn-flat">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="javascript:;" onclick="show_delete(<?= $v2['menu_id']; ?>);" class="btn btn-danger btn-xs btn-flat">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                            @endif
                        </div>
                    </h4>
                </div>
            </li>
            @endforeach
        </ol>
    </li>
    @endif
    @endforeach
</ol>
@endif

<div class="modal fade" id="modaldelete" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Confirm Delete</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div id="response_delete"></div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modaledit" tabindex="-1" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Menu</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div id="response_edit"></div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {

        $('.sortable').nestedSortable({
            forcePlaceholderSize: true,
            handle: 'div',
            helper: 'clone',
            items: 'li',
            opacity: .6,
            revert: 250,
            tabSize: 25,
            tolerance: 'pointer',
            toleranceElement: '> div',
            maxLevels: 2,
            isTree: true,
            expandOnHover: 700,
            startCollapsed: false,
            update: function() {
                serialized = $('ol.sortable').nestedSortable('serialize');
                console.log(serialized);
                $.ajax({
                    type: "get",
                    dataType: "json",
                    url: "{{ route('core.tools.menu_builder.reorder') }}",
                    data: serialized,
                    success: function(x) {
                        show_menu();
                    }
                });
            }
        });

    });

    function show_delete(id) {
        if (typeof id == "undefined") {
            return false;
        }

        $.ajax({
                url: "{{ route('core.tools.menu_builder.confirm_delete') }}",
                data: "id=" + id,
                type: "get",
                dataType: "html",
                beforeSend: function() {
                    $("#modaldelete").modal('show');
                    $("#response_delete").html('Loading')
                },
            })
            .done(function(x) {
                $("#response_delete").html(x);
            })
            .fail(function() {
                $("#response_delete").html('Server not respond');
            })
            .always(function() {

            });

    }

    function show_edit(id) {
        if (typeof id == "undefined") {
            return false;
        }

        $.ajax({
                url: "{{ route('core.tools.menu_builder.confirm_edit') }}",
                data: "id=" + id,
                type: "get",
                dataType: "html",
                beforeSend: function() {
                    $("#modaledit").modal('show');
                    $("#response_edit").html('Loading')
                },
            })
            .done(function(x) {
                $("#response_edit").html(x);
            })
            .fail(function() {
                $("#response_edit").html('Server not respond');
            })
            .always(function() {

            });

    }

    function modal_edit_hide() {
        $("#modaledit").modal('hide');
    }
</script>