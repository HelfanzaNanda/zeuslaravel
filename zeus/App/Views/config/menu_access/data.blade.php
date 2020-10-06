@if(!empty($data))
<form method="post" id="frmupdate">
    @csrf
    <input type="hidden" name="id" value="{{ $group_id}}" />
    @foreach($data as $row)
    <div class="form-group form-check">
        <input type="checkbox" name="item[{{ $row['id'] }}]" class="form-check-input" id="{{ $row['id'] }}" 
        {{ ($row['active'])?'checked=""':'' }}>
        <label class="form-check-label" for="{{ $row['id'] }}">{{ $row['title'] }}</label>
    </div>
    @endforeach
    <button type="submit" class="btn btn-primary">Save Access</button>
</form>
@endif

<script>
    $(document).ready(function() {

        $("#frmupdate").on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                    url: "{{ route('core.config.menu_access.update') }}",
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