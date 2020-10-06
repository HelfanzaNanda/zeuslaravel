<form method="post" action="{{route('core.config.module.update')}}">
    @csrf
    <input type="hidden" name="id" value="{{ $data->id }}"/>
    <div class="form-group row required">
        <label class="col-sm-2 col-form-label">Name</label>
        <div class="col-sm-10">
            <input type="text" name="name" id="name" class="form-control " placeholder="Module Name" required value="{{ $data->name }}" />
        </div>
    </div>
    <div class="form-group row ">
        <label class="col-sm-2 col-form-label">&nbsp;</label>
        <div class="col-sm-10">
            <button type="submit" class="btn btn-primary btn-flat">Save</button>
            <a href="{{ route('core.config.module.index') }}" class="btn btn-secondary btn-flat">Cancel</a>
        </div>
    </div>
</form>