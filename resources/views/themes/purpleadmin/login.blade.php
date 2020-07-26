@php
$theme_url=url('assets/themes/purpleadmin/').'/';
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>User Login</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ $theme_url }}assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="{{ $theme_url }}assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ $theme_url }}assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ $theme_url }}assets/images/favicon.png" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left p-5">
                            <div class="brand-logo">
                                <img src="{{ $theme_url }}assets/images/logo.svg">
                            </div>
                            <h4>Hello! let's get started</h4>
                            <h6 class="font-weight-light">Sign in to continue.</h6>
                            <form class="pt-3" id="frm_login">
                                @csrf
                                <div class="form-group">
                                    <input type="text" name="user_text" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password">
                                </div>
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ $theme_url }}assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ $theme_url }}assets/js/off-canvas.js"></script>
    <script src="{{ $theme_url }}assets/js/hoverable-collapse.js"></script>
    <script src="{{ $theme_url }}assets/js/misc.js"></script>
    <!-- endinject -->
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
                            window.location = "{{ route('core.account.dashboard') }}";
                        } else {
                            alert(x.message);
                        }
                    })
                    .fail(function() {
                        alert('Server not respond');
                    })
                    .always(function() {

                    });
            });

        });
    </script>
</body>

</html>