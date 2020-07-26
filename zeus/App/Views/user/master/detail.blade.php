<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous"></script>
<form method="post" id="frmupdate">
    @csrf
    <input type="hidden" name="id" value="{{ $data->id }}" />
    <div class="form-group row required">
        <label class="col-form-label col-sm-2">User Group</label>
        <div class="col-md-7">
            <select id="group" name="group" class="form-control ipts select2" required="" style="width: 100%" data-placeholder="Choose User Group">
                <option></option>
                @if(!empty($group))
                @foreach($group as $g)
                @if($g->meta_key != 'superadmin')
                <option value="{{ $g->id }}" {{ ($data->user_group_id == $g->id)?'selected=""':'' }}>{{ $g->meta_value}}</option>
                @endif
                @endforeach
                @endif
            </select>
        </div>
    </div>
    <div class="form-group row required">
        <label for="name" class="col-sm-2 col-form-label">Name</label>
        <div class="col-sm-7">
            <input type="text" class="form-control" name="name" id="name" value="{{ $data->name }}">
        </div>
    </div>
    <div class="form-group row required">
        <label for="email" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-5">
            <input type="email" class="form-control" name="email" id="email" value="{{ $data->email }}">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">&nbsp;</label>
        <div class="col-sm-9">
            <label class="checkbox-inline">
                <input type="checkbox" name="chp" id="chp" /> Reset Password
            </label>
        </div>
    </div>
    <?php
    $arr = array('p2' => 'New Password', 'p3' => 'Confirm Password');
    foreach ($arr as $k => $v) {
    ?>
        <div class="form-group row chp-div" style="display:none;">
            <label class="col-sm-2 col-form-label"><?= $v; ?></label>
            <div class="col-sm-4">
                <input type="password" name="<?= $k; ?>" id="<?= $k; ?>" class="form-control chp-input" autocomplete="off" placeholder="Entri <?= $v; ?>" />
            </div>
        </div>
    <?php
    }
    ?>
    <div class="form-group  row">
        <label class="control-label col-sm-3">&nbsp;</label>
        <div class="col-md-9">
            <button type="submit" class="btn btn-flat btn-primary">Update</button>
        </div>
    </div>
</form>

<script>
    $(document).ready(function() {
        $(".select2").select2();
        $("#chp").on('change', function() {
            if (this.checked) {
                $(".chp-input").val('');
                $(".chp-input").attr('required', true);
                $(".chp-div").show('fade');
            } else {
                $(".chp-input").val('');
                $(".chp-input").attr('required', false);
                $(".chp-div").hide('fade');
            }
        });

        $("#tukarphoto").click(function(e) {
            e.preventDefault();
            $("#file").trigger('click');
        });

        $("#file").change(function() {
            var photo = $(this).val();
            if (photo == "") {
                return false;
            } else {
                $("#formphoto").trigger('submit');
            }
        });

        $("#frmupdate").on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                    url: "{{route('core.user.master.update')}}",
                    data: $(this).serialize(),
                    type: "post",
                    dataType: "json",
                    beforeSend: function() {
                        overlay_show();
                    },
                })
                .done(function(x) {
                    if (x.status == true) {
                        alert(x.message);
                        window.location="{{ route('core.user.master') }}";
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