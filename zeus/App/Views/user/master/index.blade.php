@push('assets')
@php
echo cdn_datatables();
echo cdn_select2();
@endphp
@endpush
<p>
    <div class="row">
        <div class="col-md-2">
            <a href="{{ route('core.user.master.add') }}" class="btn btn-primary btn-flat btn-md">Add User</a>
        </div>
        <div class="col-md-3">
            <select id="status" data-allow-clear="true" class="form-control select2" style="width:100%" data-placeholder="Choose Status">
                <option></option>
                <option value="0">InActive</option>
                <option value="1">Active</option>
            </select>
        </div>
        <div class="col-md-5">
            <select id="group" class="form-control select2" style="width:100%" data-allow-clear="true" data-placeholder="Choose User Group">
                <option></option>
                @if(!empty($group))
                @foreach($group as $g)
                @if($g->meta_key != 'superadmin')
                <option value="{{ $g->id }}">{{ $g->meta_value}}</option>
                @endif
                @endforeach
                @endif
            </select>
        </div>

    </div>
</p>

<div class="table-responsive">
    <table class="table table-bordered table-hover" id="datatables">
        <thead>
            <th>Full Name</th>
            <th>User Group</th>
            <th>Email</th>
            <th>Status</th>
            <th>Action</th>
        </thead>
        <tbody></tbody>
    </table>
</div>
@push('assets')
<script>
    $(document).ready(function() {

        $(".select2").select2();
        refresh_data();

        $("#status").on('change', function() {
            refresh_data();
        });

        $("#group").on('change', function() {
            refresh_data();
        });

    });

    function refresh_data() {
        var status = $("#status").val();
        if (typeof status == 'undefined') {
            status = '';
        }
        var group = $("#group").val();
        if (typeof group == 'undefined') {
            group = '';
        }
        $('#datatables').dataTable().fnDestroy();
        $('#datatables').DataTable({
            serverSide: true,
            processing: true,
            ajax: '<?= route("core.user.master.datatables"); ?>?status=' + status + "&group=" + group,
            columns: [{
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'group',
                    name: 'group'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action'
                }
            ]
        });
    }
</script>
@endpush