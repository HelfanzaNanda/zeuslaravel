@php
$theme_url=url('assets/themes/adminlte3/').'/';
@endphp
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>User Login</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ $theme_url }}plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ $theme_url }}plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ $theme_url }}dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ route('login') }}"><b>{{ meta_read('app_name') }}</b></a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form id="frm_login" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Email or Username" name="user_text" required value="{{ old('user_text') }}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password" id="password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <a href="javascript:;" onclick="show_forgot_password();">Forgot Password</a>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <p>
                                <div id="error_response"></div>
                            </p>
                        </div>
                    </div>
                </form>

            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->
    <div class="modal" tabindex="-1" role="dialog" id="modal_forgot_password" data-backdrop='static'>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Forgot Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <form method="post" id="frmforgot">
                                @csrf
                                <div class="input-group mb-3">
                                    <input type="email" class="form-control" placeholder="Email" name="email" required value="">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-envelope"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        &nbsp;
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-8">
                                        <button type="submit" class="btn btn-primary">Send Verication Link</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    </div>
                                    <!-- /.col -->
                                </div>
                            </form>
                        </div>
                        <div class="overlay" style="display: none;">
                            <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- jQuery -->
    <script src="{{ $theme_url }}plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ $theme_url }}plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ $theme_url }}dist/js/adminlte.min.js"></script>
    <script>
        $(document).ready(function() {

            $("#frm_login").on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                        url: "{{ route('login.do') }}",
                        data: $(this).serialize(),
                        type: "post",
                        dataType: "json",
                        beforeSend: function() {

                        },
                    })
                    .done(function(x) {
                        if (x.status == true) {
                            if (x.redirect_url != '') {
                                window.location = x.redirect_url;
                            } else {
                                window.location = "{{ route('core.account.dashboard') }}";
                            }
                        } else {
                            $("#error_response").html('<div class="alert alert-danger">' + x.message + '</div>');
                            $("#password").val("");
                        }
                    })
                    .fail(function() {
                        alert('Server not respond');
                    })
                    .always(function() {

                    });
            });

            $("#frmforgot").on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                        url: "{{ route('login.send_verification') }}",
                        data: $(this).serialize(),
                        type: "post",
                        dataType: "json",
                        beforeSend: function() {
                            $(".overlay").show();
                        },
                    })
                    .done(function(x) {
                        if (x.status == true) {
                            alert(x.message)
                            location.reload();
                        } else {
                            alert(x.message)
                        }
                        $(".overlay").hide();
                    })
                    .fail(function() {
                        alert('Server not respond');
                        $(".overlay").hide();
                    })
                    .always(function() {

                    });
            });

        });

        function show_forgot_password() {
            $("#modal_forgot_password").modal('show');
        }
    </script>
</body>

</html>