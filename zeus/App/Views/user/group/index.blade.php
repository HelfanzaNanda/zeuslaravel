<div class="card">
    <div class="card-header">
        Add User Group
    </div>
    <div class="card-body">
        <form method="post" id="frmadd">
            @csrf
            <div class="form-group row required">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" name="name" id="name" value="">
                </div>
            </div>
            <div class="form-group row required">
                <label for="name" class="col-sm-2 col-form-label">Key</label>
                <div class="col-sm-7">
                    <input type="text" class="form-control" name="key" id="key" value="">
                </div>
            </div>
            <div class="form-group  row">
                <label class="control-label col-sm-2">&nbsp;</label>
                <div class="col-md-9">
                    <button type="submit" class="btn btn-flat btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <th>Group Name</th>
            <th>Group Key</th>
            <th></th>
        </thead>
        <tbody>
            @if(!empty($data))
            @foreach($data as $row)
            @if($row->meta_key != 'superadmin')
            <tr>
                <td>{{ $row->meta_value }}</td>
                <td>{{ $row->meta_key }}</td>
                <td>
                    <a href="{{ route('core.user.group.delete',$row->id) }}" onclick="return confirm('Are you sure delete this data?');" class="btn btn-danger btn-md">Delete</a>
                    <a href="{{ route('core.user.group.access',$row->id) }}" class="btn btn-primary btn-md">Access Module</a>
                </td>
            </tr>
            @endif
            @endforeach
            @endif
        </tbody>
    </table>
</div>

@push('assets')
<script>
    $(document).ready(function() {

        $("#key").on({
            keydown: function(e) {
                if (e.which === 32)
                    return false;
            },
            change: function() {
                this.value = this.value.replace(/\s/g, "");
            }
        });

        $("#frmadd").on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                    url: "{{ route('core.user.group.store') }}",
                    data: $(this).serialize(),
                    type: "post",
                    dataType: "json",
                    beforeSend: function() {
                        overlay_show();
                    },
                })
                .done(function(x) {
                    if (x.status == true) {
                        $("#name").val("");
                        $("#key").val("");
                        alert(x.message);
                        location.reload();
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
@endpush