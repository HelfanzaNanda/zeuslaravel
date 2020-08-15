<div class="card">
    <div class="card-header">Application Meta</div>
    <div class="card-body">
        <form method="post" action="{{ route('core.config.app_update') }}">
            @csrf
            <div class="form-group row required">
                <label class="col-form-label col-sm-3">Template</label>
                <div class="col-md-5">

                    <input type="text" name="item[backend_theme]" class="form-control" require value="{{ meta_read('backend_theme') }}" />
                </div>
            </div>
            <div class="form-group row required">
                <label class="col-form-label col-sm-3">Name</label>
                <div class="col-md-8">
                    <input type="text" name="item[app_name]" class="form-control" require value="{{ meta_read('app_name') }}" />
                </div>
            </div>
            <div class="form-group row required">
                <label class="col-form-label col-sm-3">Version</label>
                <div class="col-md-4">
                    <input type="text" name="item[app_version]" class="form-control" require value="{{ meta_read('app_version') }}" />
                </div>
            </div>
            <div class="form-group row required">
                <label class="col-form-label col-sm-3">Year</label>
                <div class="col-md-4">
                    <input type="number" name="item[app_year]" class="form-control" require value="{{ meta_read('app_year') }}" />
                </div>
            </div>
            <div class="form-group row">
                <label class="col-form-label col-sm-3">&nbsp;</label>
                <div class="col-md-9">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">Logo & Favicon</div>
    <div class="card-body">
        <?php
        $arr = array('logo', 'favicon');
        echo '<div class="row">';
        foreach ($arr as $k) {
            $img = zeus_logo(200);
            if ($k == "favicon") {
                $img = zeus_favicon(200);
            }
            echo '<div class="col-md-6">';
        ?>
            <form class="form-horizontal" method="post" enctype="multipart/form-data" action="{{ route('core.config.logo_update') }}">
                @csrf
                <input type="hidden" name="type" value="<?= $k; ?>" />
                <div class="form-group required">
                    <label class="control-label col-sm-2"><?= ucwords($k); ?></label>
                    <div class="col-md-4">
                        <img src="<?= $img; ?>" style="width: 120px;height: 130px;" />
                        <br /><br />
                        <input type="file" name="<?= $k; ?>" />
                        <span class="helpBlock">Choose File to change <?= $k; ?></span>
                    </div>
                </div>

                <?php
                ?>
                <div class="form-group ">
                    <label class="control-label col-sm-2">&nbsp;</label>
                    <div class="col-md-10">
                        <button type="submit" class="btn btn-primary btn-flat">Upload</button>
                    </div>
                </div>
            </form>
        <?php
            echo '</div>';
        }
        echo '</div>';
        ?>
    </div>
</div>