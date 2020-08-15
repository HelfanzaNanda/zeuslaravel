@php
$theme_url=url('assets/themes/adminlte3/').'/';
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>{{ $header['title'] }}</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ $theme_url }}plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ $theme_url }}dist/css/adminlte.min.css">
    <link rel="stylesheet" href="{{ $theme_url }}dist/css/custom.css">
    <!-- Google Font: Source Sans Pro -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <!-- jQuery -->
    <script src="{{ $theme_url }}plugins/jquery/jquery.min.js"></script>
    @include('zeus::layout.header')
</head>


<body class="hold-transition sidebar-mini layout-fixed">

    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i class="fas fa-user"></i> {{ user_info('name') }}</a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ route('core.account.dashboard') }}" class="brand-link">
                <img src="{{ zeus_favicon() }}" alt="AdminLTE Docs Logo Small" class="brand-image-xl logo-xs" style="width:90%">
                <img src="{{ zeus_logo(800) }}" class="brand-image-xl logo-xl" style="width:90%">
                <span class="brand-text font-weight-light">&nbsp;</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ user_avatar() }}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ user_info('name') }}</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="{{ route('core.account.dashboard') }}" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        @include('themes.adminlte3.navigation')
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                @if (session('error'))
                <div class="alert alert-danger">
                    <i class="fa fa-exclamation-triangle message-header"></i> {{ session('error') }}
                </div>
                @endif

                @if ($errors->any())
                <div class="alert alert-danger message-header">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if (session('success'))
                <div class="alert alert-success message-header">
                    {{ session('success') }}
                </div>
                @endif

                @if (session('warning'))
                <div class="alert alert-warning message-header">
                    {{ session('warning') }}
                </div>
                @endif
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">{{ $header['title'] }}</h1>
                        </div><!-- /.col -->
                        @if(!empty($header['breadcrumb']))
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                @foreach($breadcrumb as $breadcrumb_item)
                                @if($breadcrumb_item->last())
                                <li class="breadcrumb-item active"><a href="{{ $breadcrumb_item['link'] }}">{{ $breadcrumb_item['name'] }}</a></li>
                                @else
                                <li class="breadcrumb-item"><a href="{{ $breadcrumb_item['link'] }}">{{ $breadcrumb_item['name'] }}</a></li>
                                @endif
                                @endforeach
                            </ol>
                        </div>
                        @endif
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="card card-solid">
                        <div class="card-body pb-0">
                            @include($content)
                        </div>
                    </div>
                    @if(isset($content_footer))
                    <div class="card-footer">
                        @include($content_footer)
                    </div>
                    @endif
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3 text-center">
                <img src="{{ user_avatar() }}" class="profile-user-img img-fluid img-circle" />
                <h5>{{ user_info('name') }}</h5>
                <p>{{ user_role_name() }}</p>
                <p>
                    <a href="{{ route('core.account.profile') }}" class="btn btn-primary">Profile</a>
                    <a href="{{ route('core.account.signout') }}" class="btn btn-danger">Sign Out</a>
                </p>
            </div>
            <div class="p-3">
                <div class="form-group">
                    <label>Email</label>
                    <p>{{ user_info('email') }}</p>
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <p>{{ user_info('username') }}</p>
                </div>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>
            <!-- Default to the left -->
            <strong>{!! app_copyright() !!}.</strong> All rights reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->


    <!-- Bootstrap 4 -->
    <script src="{{ $theme_url }}plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ $theme_url }}dist/js/adminlte.min.js"></script>
    @include('zeus::layout.footer')
</body>

</html>