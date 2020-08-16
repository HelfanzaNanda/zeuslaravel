<form method="post" id="frmsend">
    @csrf

    <div class="form-group row required">
        <label class="col-form-label col-sm-2">To</label>
        <div class="col-md-10">
            <input type="email" name="to" id="to" class="form-control " placeholder="Send to" required value="" />
        </div>
    </div>
    <div class="form-group row required">
        <label class="col-form-label col-sm-2">Subject</label>
        <div class="col-md-10">
            <input type="text" name="subject" id="subject" class="form-control " placeholder="Subject" required value="" />
        </div>
    </div>
    <div class="form-group row required">
        <label class="col-form-label col-sm-2">Message</label>
        <div class="col-md-10">
            <textarea id="editor" name="message" class="form-control">Hello, World!</textarea>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-form-label col-sm-2">Attachment</label>
        <div class="col-md-3">
            <?php
            for ($i = 0; $i <= 2; $i++) {
            ?>
                <input type="file" name="file[{{$i}}]" />
            <?php
            }
            ?>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-form-label col-sm-2">&nbsp;</label>
        <div class="col-md-3">
            <button type="submit" class="btn btn-primary btn-flat">Send Email</button>
        </div>
    </div>

</form>
@push('assets')
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.5.12/tinymce.min.js" integrity="sha512-d0g+KQCJo+/uZT1AnOD2d00LepW5V3kSyIG7s3ruia6gb1k3V1rcIOu7qTDAnNHEauhrQEGML7vkV3htQOIAxA==" crossorigin="anonymous"></script>
<script>
    tinymce.init({
        selector: 'textarea'
    });

    $(document).ready(function() {
        $("#frmsend").on('submit', function(e) {
            e.preventDefault();
            tinymce.triggerSave();
            var formData = new FormData($(this)[0]);
            $.ajax({
                    url: "{{ route('core.tools.send_email.do') }}",
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
                        alert('Success');
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
@endpush