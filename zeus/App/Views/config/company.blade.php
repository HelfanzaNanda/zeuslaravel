<form method="post" action="{{ route('core.config.company_update') }}">
    @csrf
    <div class="form-group row required">
        <label class="col-form-label col-sm-2">Name</label>
        <div class="col-md-8">
            <input type="text" name="item[company_name]" class="form-control" require value="{{ meta_read('company_name') }}" />
        </div>
    </div>
    <div class="form-group row">
        <label class="col-form-label col-sm-2">Address</label>
        <div class="col-md-10">
            <input type="text" name="item[company_address]" class="form-control" value="{{ meta_read('company_address') }}" />
        </div>
    </div>
    <div class="form-group row">
        <label class="col-form-label col-sm-2">Phone</label>
        <div class="col-md-4">
            <input type="text" name="item[company_phone]" class="form-control" value="{{ meta_read('company_phone') }}" />
        </div>
    </div>
    <div class="form-group row">
        <label class="col-form-label col-sm-2">Email</label>
        <div class="col-md-4">
            <input type="text" name="item[company_email]" class="form-control" value="{{ meta_read('company_email') }}" />
        </div>
    </div>
    <div class="form-group row">
        <label class="col-form-label col-sm-2">URL</label>
        <div class="col-md-4">
            <input type="text" name="item[company_web]" class="form-control" value="{{ meta_read('company_web') }}" />
        </div>
    </div>
    <div class="form-group row">
        <label class="col-form-label col-sm-2">&nbsp;</label>
        <div class="col-md-9">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>
</form>