<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/jquery.dataTables.min.css" integrity="sha512-1k7mWiTNoyx2XtmI96o+hdjP8nn0f3Z2N4oF/9ZZRgijyV4omsKOXEnqL1gKQNPy2MTSP9rIEWGcH/CInulptA==" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap4.min.css" integrity="sha512-PT0RvABaDhDQugEbpNMwgYBCnGCiTZMh9yOzUsJHDgl/dMhD9yjHAwoumnUk3JydV3QTcIkNDuN40CJxik5+WQ==" crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js" integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/dataTables.bootstrap4.min.js" integrity="sha512-OQlawZneA7zzfI6B1n1tjUuo3C5mtYuAWpQdg+iI9mkDoo7iFzTqnQHf+K5ThOWNJ9AbXL4+ZDwH7ykySPQc+A==" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous"></script>
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