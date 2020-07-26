<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous"></script>

<form method="post" id="frmadd" enctype="multipart/form-data" class="form-horizontal">
    @csrf

    <div class="form-group row required">
        <label class="col-form-label col-sm-2">User Group</label>
        <div class="col-md-7">
            <select id="group" name="group" class="form-control ipts select2" required="" style="width: 100%" data-placeholder="Choose User Group">
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
    <div class="form-group row required">
        <label class="col-form-label col-sm-2">Full Name</label>
        <div class="col-md-10">
            <input type="text" name="full_name" id="full_name" class="form-control ipt" required="" placeholder="Full Name" value="{{old('full_name')}}" />
        </div>
    </div>
    <div class="form-group row required">
        <label class="col-form-label col-sm-2">Username</label>
        <div class="col-md-4">
            <input type="text" name="username" id="username" class="form-control ipt" required="" placeholder="Username" value="{{old('username')}}" />
        </div>
    </div>
    <div class="form-group row required">
        <label class="col-form-label col-sm-2">Email</label>
        <div class="col-md-6">
            <input type="email" name="email" id="email" class="form-control ipt" required="" placeholder="Email" value="{{old('email')}}" />
        </div>
    </div>
    <?php
    $arr = array('p2' => 'New Password', 'p3' => 'Confirm Password');
    foreach ($arr as $k => $v) {
    ?>
        <div class="form-group row chp-div required">
            <label class="col-sm-2 col-form-label"><?= $v; ?></label>
            <div class="col-sm-4">
                <input type="password" name="<?= $k; ?>" id="<?= $k; ?>" class="form-control chp-input" autocomplete="off" placeholder="Entri <?= $v; ?>" />
            </div>
        </div>
    <?php
    }
    ?>
    <div class="form-group row">
        <label class="col-form-label col-sm-2">&nbsp;</label>
        <div class="col-md-10">
            <button type="submit" class="btn btn-primary">Add User</button>
            <a href="{{route('core.user.master')}}" class="btn btn-default">Cancel</a>
        </div>
    </div>

</form>

<script>
    $(document).ready(function() {
        $(".select2").select2();

        $("#username").on({
            keydown: function(e) {
                if (e.which === 32)
                    return false;
            },
            change: function() {
                this.value = this.value.replace(/\s/g, "");
            }
        });

        $("#email").on({
            keydown: function(e) {
                if (e.which === 32)
                    return false;
            },
            change: function() {
                this.value = this.value.replace(/\s/g, "");
            }
        });

        $("#p1").on({
            keydown: function(e) {
                if (e.which === 32)
                    return false;
            },
            change: function() {
                this.value = this.value.replace(/\s/g, "");
            }
        });

        $("#p2").on({
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
            var formData = new FormData($(this)[0]);
            $.ajax({
                    url: "{{route('core.user.master.store')}}",
                    data: formData,
                    type: "post",
                    dataType: "json",
                    async: true,
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        overlay_show();
                    },
                })
                .done(function(x) {
                    if (x.status == true) {
                        if (x.reload == 0) {
                            alert(x.message);
                            $(".ipt").val('');
                            $(".ipts").val('').trigger('change');
                        } else if (x.reload == 1) {
                            alert(x.message);
                            window.location = "{{route('core.user.master')}}";
                        }
                    } else {
                        alert(x.message);
                    }
                    overlay_hide();
                })
                .fail(function() {
                    alert('Server not respond!!');
                    overlay_hide();
                })
                .always(function() {

                });
        });

    });
</script>