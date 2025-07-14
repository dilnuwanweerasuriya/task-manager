<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | {{ $title }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @foreach ($css as $path)
        <link href="{{ $path }}" rel="stylesheet">
    @endforeach

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    @foreach ($script as $path)
        <script src="{{ $path }}"></script>
    @endforeach
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        {{ Auth::user()->name }}
                        <i class="right fas fa-angle-down ml-2"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <div class="dropdown-divider"></div>
                        <a href="/user-profile" class="dropdown-item">
                            <i class="fa fa-user mr-2"></i> Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="/main/logout" class="dropdown-item">
                            <i class="fas fa-sign-out-alt mr-2"></i> Log Out
                        </a>
                    </div>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"
                        role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li> --}}


            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="/" class="brand-link">
                <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">Task Manager</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="/dist/img/avatar5.png" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="/user-profile" class="d-block">{{ Auth::user()->name }}</a>
                    </div>
                </div>

                <nav class="mt-2">
                    <?php
                    $sidebar = [];
                    $configSidebar = config('sidebar');

                    foreach ($configSidebar as $level1) {
                        foreach ($level1['childs'] as $level2) {
                            if (is_array(session('permissions')) && (!isset($level2['permission']) || in_array($level2['permission'], session('permissions')))) {
                                $title1 = $level1['title'];

                                if (isset($sidebar[$title1])) {
                                    $sidebar[$title1]['childs'][] = $level2;
                                } else {
                                    $sidebar[$title1] = [
                                        'title' => $title1,
                                        'icon' => $level1['icon'],
                                        'type' => $level1['type'],
                                        'childs' => [$level2],
                                    ];
                                }
                            }
                        }
                    }
                    ?>

                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        @foreach ($sidebar as $key1 => $level1)
                            @if ($level1['type'] == 'single')
                                @foreach ($level1['childs'] as $level2)
                                    <li class="nav-item">
                                        <a href="{{ url($level2['link']) }}" class="nav-link">
                                            <i class="nav-icon {{ $level1['icon'] }}"></i>
                                            <p>
                                                {{ $level2['title'] }}
                                            </p>
                                        </a>
                                    </li>
                                @endforeach
                            @else
                                <li class="nav-item has-treeview menu">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon {{ $level1['icon'] }}"></i>
                                        <p>
                                            {{ $level1['title'] }}
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        @foreach ($level1['childs'] as $level2)
                                            <li class="nav-item">
                                                <a href="{{ url($level2['link']) }}" class="nav-link">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>{{ $level2['title'] }}</p>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </nav>

            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">{{ Str::upper($title) }}</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active text-capitalize">{{ $title }}</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <section class="content">
                @include($view)
            </section>

        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2024 <a href="http://adminlte.io">Dilnuwan Weerasuriya</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.0.4
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    <script>
        $(document).ready(function() {
            var currentUrl = window.location.pathname;

            $('.nav-link').each(function() {
                var href = $(this).attr('href');
                var route = $(this).data('route');

                if (currentUrl === href || currentUrl.includes(route)) {
                    $(this).addClass('active');
                    var $parent = $(this).closest('.nav-item.has-treeview');
                    if ($parent.length) {
                        $parent.addClass('menu-open');
                        $parent.find('> .nav-link').addClass('active');
                    }
                }
            });
        });
    </script>
</body>

</html>

@if (session('success'))
    <script>
        $(document).ready(function() {
            Swal.fire("Good job!", "{{ session('success') }}", "success");
        });
    </script>
@endif

@if (session('error'))
    <script>
        $(document).ready(function() {
            Swal.fire("Oops!", "{{ session('error') }}", "error");
        });
    </script>
@endif
