<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Change Your Password</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha512-MoRNloxbStBcD8z3M/2BmnT+rg4IsMxPkXaGh2zD6LGNNFE80W3onsAhRcMAMrSoyWL9xD7Ert0men7vR8LUZg==" crossorigin="anonymous" />

    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: -ms-flexbox;
            display: -webkit-box;
            display: flex;
            -ms-flex-align: center;
            -ms-flex-pack: center;
            -webkit-box-align: center;
            align-items: center;
            -webkit-box-pack: center;
            justify-content: center;
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #f5f5f5;
        }

        .form-signin {
            width: 100%;
            max-width: 330px;
            padding: 15px;
            margin: 0 auto;
        }

        .form-signin .checkbox {
            font-weight: 400;
        }

        .form-signin .form-control {
            position: relative;
            box-sizing: border-box;
            height: auto;
            padding: 10px;
            font-size: 16px;
        }

        .form-signin .form-control:focus {
            z-index: 2;
        }

        .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }

        .m-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 9999999;
            background: rgba(0, 0, 0, 0.5);
            border-radius: 3px;
            overflow: hidden;
        }

        .m-overlay>.m-overlay-text {
            position: relative;
            top: 50%;
            left: 0%;
            margin-left: -15px;
            margin-top: -15px;
            color: #fff;
            font-size: 30px;
        }
    </style>
</head>

<body class="text-center">
    <form class="form-signin" id="formupdate">
        @csrf
        <h1 class="h3 mb-3 font-weight-normal">Please change your password</h1>
        <div class="card">
            <div class="card-body">
                <label for="pass1" class="sr-only">New Password</label>
                <input type="password" name="pass1" id="pass1" class="form-control" placeholder="New Password" required autofocus>
                <label for="pass2" class="sr-only">Confirm Password</label>
                <input type="password" name="pass2" id="pass2" class="form-control" placeholder="Confirm Password" required>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Update</button>
            </div>
        </div>
    </form>
    <div class="m-overlay" style="display: none;">
        <div class="m-overlay-text">
            <i class="fa fa-spin fa-refresh"></i>
            <span id="m-overlay-title">Loading</span>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {

            $("#formupdate").on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                        url: "{{ route('login.forgot.update_password') }}",
                        data: $(this).serialize(),
                        type: "post",
                        dataType: "json",
                        beforeSend: function() {
                            overlay_show();
                        },
                    })
                    .done(function(x) {
                        if (x.status == true) {
                            window.location="{{ route('login') }}";
                        }else{
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

        function overlay_show() {
            $(".m-overlay").show()
        }

        function overlay_hide() {
            setTimeout(function() {
                $(".m-overlay").hide()
            }, 500)
        }
    </script>
</body>

</html>