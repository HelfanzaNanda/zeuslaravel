@push('assets')
@php
echo cdn_datatables();
echo cdn_select2();
@endphp
@endpush('assets')

<div class="row">
    <div class="col-12">
        <form method="post" action="{{route('core.config.module_sub.update')}}">
            @csrf
            <input type="hidden" name="id" value="{{ $data->id }}" />
            <div class="form-group row required">
                <label class="col-sm-2 col-form-label">Module Name</label>
                <div class="col-sm-10">
                    <select name="module_id" id="module_id" class="form-control select2" style="width:100%" data-placeholder="Choose Module" data-allow-clear="true" required>
                        <option></option>
                        @foreach($data_module as $row)
                        <option value="{{ $row->id }}" {{ ($row->id == $data->zeus_module_id)?'selected=""':'' }}>{{ $row->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row required">
                <label class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" name="name" id="name" class="form-control " placeholder="Module Name" required value="{{ $data->name }}" />
                </div>
            </div>
            <div class="form-group row required">
                <label class="col-sm-2 col-form-label">Route Name</label>
                <div class="col-sm-10">
                    <select name="route" id="route" class="form-control select2" style="width:100%" data-placeholder="Choose Route Name" data-allow-clear="true" required>
                        <option></option>
                        @foreach($route_list as $rl)
                        <option value="{{ $rl }}" {{ ($data->route_name == $rl)?'selected=""':'' }}>{{ $rl }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row ">
                <label class="col-sm-2 col-form-label">&nbsp;</label>
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary btn-flat">Save</button>
                    <a href="{{ route('core.config.module_sub.index') }}" class="btn btn-secondary btn-flat">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>

@push('assets')
<script>
    $(document).ready(function() {

        $(".select2").select2();

    });
</script>
@endpush('assets')