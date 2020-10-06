@push('assets')
@php
echo cdn_datatables();
echo cdn_select2();
@endphp
@endpush('assets')

<div class="row">
    <div class="col-12">
        <form method="post" action="{{route('core.config.module_sub.store')}}">
            @csrf
            <div class="form-group row required">
                <label class="col-sm-2 col-form-label">Module Name</label>
                <div class="col-sm-10">
                    <select name="module_id" id="module_id" class="form-control select2" style="width:100%" data-placeholder="Choose Module" data-allow-clear="true" required>
                        <option></option>
                        @foreach($data_module as $row)
                        <option value="{{ $row->id }}">{{ $row->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row required">
                <label class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" name="name" id="name" class="form-control " placeholder="Module Name" required value="{{ old('name') }}" />
                </div>
            </div>
            <div class="form-group row required">
                <label class="col-sm-2 col-form-label">Route Name</label>
                <div class="col-sm-10">
                    <select name="route" id="route" class="form-control select2" style="width:100%" data-placeholder="Choose Route Name" data-allow-clear="true" required>
                        <option></option>
                        @foreach($route_list as $rl)
                        <option value="{{ $rl }}">{{ $rl }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row ">
                <label class="col-sm-2 col-form-label">&nbsp;</label>
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary btn-flat">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
<hr />
<div class="row">
    <div class="col-md-12">
        <p>
            <div class="row">
                <div class="col-6">
                    <select id="module" class="form-control select2" style="width:100%" data-placeholder="Choose Module" data-allow-clear="true" required>
                        <option></option>
                        @foreach($data_module as $row)
                        <option value="{{ $row->id }}">{{ $row->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </p>
        <div class="table-responsive">
            <table class="table table-bordered" id="datatables">
                <thead>
                    <th>ID</th>
                    <th>Module Name</th>
                    <th>Sub Module Name</th>
                    <th>Route Name</th>
                    <th></th>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
@push('assets')
<script>
    $(document).ready(function() {

        $(".select2").select2();
        refresh_data();

        $("#module").on('change', function() {
            refresh_data();
        });

    });

    function refresh_data() {
        var module = $("#module").val();
        if (typeof module == "undefined") {
            module = "";
        }
        $('#datatables').dataTable().fnDestroy();
        $('#datatables').DataTable({
            serverSide: true,
            processing: true,
            order:[0,'desc'],
            ajax: "{{ route('core.config.module_sub.datatables') }}?module=" + module,
            columns: [{
                data: 'id',
                name: 'zeus_module.id'
            }, {
                data: 'module_name',
                name: 'zeus_module.name'
            }, {
                data: 'name',
                name: 'zeus_module_sub.name'
            }, {
                data: 'route_name',
                name: 'zeus_module_sub.route_name'
            }, {
                data: 'action',
                name: 'action'
            }]
        });
    }
</script>
@endpush('assets')