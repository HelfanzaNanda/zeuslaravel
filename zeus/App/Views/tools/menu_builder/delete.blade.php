<form method="post" id="frmdelete">
    @csrf
    <input type="hidden" name="id" value="{{ $data->id }}" />
    <h4>Are you sure delete {{ $data->title }} ?</h4>
    @if($count_child > 0)
    <div class="checkbox">
        <label>
            <input type="checkbox" name="child" /> Delete all child menu
        </label>
    </div>
    @endif
    <hr />
    <button type="submit" class="btn btn-danger btn-md">Delete</button>
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

</form>

<script>
    $(document).ready(function() {

        $("#frmdelete").on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                    url: "{{ route('core.tools.menu_builder.menu_delete') }}",
                    data: $(this).serialize(),
                    type: "post",
                    dataType: "json",
                    beforeSend: function() {
                        $("#modaldelete").modal('hide');
                        overlay_show();
                    },
                })
                .done(function(x) {
                    if (x.status == true) {
                        show_menu();
                    }else{
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