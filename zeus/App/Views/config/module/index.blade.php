@push('assets')
@php
echo cdn_datatables();
@endphp
@endpush('assets')

<div class="row">
    <div class="col-12">
        <form method="post" action="{{route('core.config.module.store')}}">
            @csrf
            <div class="form-group row required">
                <label class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" name="name" id="name" class="form-control " placeholder="Module Name" required value="{{ old('name') }}" />
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

<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-bordered" id="datatables">
                <thead>
                    <th>Module Name</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach($data as $row)
                    <tr>
                        <td>{{ $row->name }}</td>
                        <td>
                            <a href="{{ route('core.config.module.edit',['id'=>$row->id]) }}" class="btn btn-info btn-sm">Edit</a>
                            <a onclick="return confirm('Are you sure delete this module?');" href="{{ route('core.config.module.delete',['id'=>$row->id]) }}" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@push('assets')
<script>
    $(document).ready(function() {

        $("#datatables").DataTable();

    });
</script>
@endpush('assets')