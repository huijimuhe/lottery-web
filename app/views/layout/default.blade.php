<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>抽奖系统-@yield('title')</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}"/>
        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="http://cdn.bootcss.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="http://cdn.bootcss.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{asset('public/css/AdminLTE.min.css')}}">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
             folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="{{asset('public/css/skins/skin-green-light.min.css')}}">
        <!-- iCheck -->
        <link rel="stylesheet" href="{{asset('public/plugins/iCheck/flat/blue.css')}}"> 
        <!-- Date Picker -->
        <link rel="stylesheet" href="{{asset('public/plugins/datepicker/datepicker3.css')}}">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="{{asset('public/plugins/daterangepicker/daterangepicker-bs3.css')}}">
        <!-- bootstrap wysihtml5 - text editor -->
        <link rel="stylesheet" href="{{asset('public/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
        <!-- video.js -->
        <link rel="stylesheet" href="http://cdn.bootcss.com/video.js/5.2.1/video-js.min.css">

        <!-- HTML5 Shim and Respond.js')}} IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js')}} doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="http://cdn.bootcss.com/html5shiv/3.7.3/html5shiv-printshiv.min.js"></script>
            <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="hold-transition skin-green-light sidebar-mini">
        <div class="wrapper">

            <header class="main-header">
                <!-- Logo -->
                <a href="#" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><b>抽奖</b></span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><b>抽奖系统</b></span>
                </a>
                <!-- Header Navbar: style can be found in header.less -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">  
                            <!-- User Account: style can be found in dropdown.less -->
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-user"></i>
                                    @if (Auth::check())
                                    <span class="hidden-xs"> {{Auth::user()->name}}
                                    </span>
                                    @endif
                                </a>
                                <ul class="dropdown-menu"> 
                                    <!-- Menu Footer-->
                                    <li class="user-footer"> 
                                        <div class="pull-left">   
                                            @if (Auth::check())
                                            {{Auth::user()->name}}
                                            @endif
                                        </div>
                                        <div class="pull-right">
                                            <a href="{{ URL::route('logout') }}" class="btn btn-default btn-flat">退出</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>

            <!-- =============================================== -->

            <!-- Left side column. contains the sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">   
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu"> 
                        <li >
                            <a href="{{URL::route('dashboard')}}">
                                <i class="fa fa-dashboard"></i> <span>首页</span>
                            </a> 
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-gift"></i>
                                <span>奖品管理</span> 
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="{{URL::route('gifts.create')}}"><i class="fa fa-circle-o"></i>新建</a></li>
                                <li><a href="{{URL::route('gifts.index')}}"><i class="fa fa-circle-o"></i>列表</a></li>   
                            </ul>
                        </li> 
                         <li class="treeview">
                            <a href="#">
                                <i class="fa  fa-gears"></i>
                                <span>参数管理</span> 
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu"> 
                                <li><a href="{{URL::route('confs.index')}}"><i class="fa fa-circle-o"></i>列表</a></li>  
                            </ul>
                        </li>   
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-users"></i>
                                <span>用户管理</span> 
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="{{URL::route('accounts.index')}}"><i class="fa fa-circle-o"></i>列表</a></li>  
                            </ul>
                        </li> 
                        <li class="treeview">
                            <a href="#">
                                <i class="fa  fa-trophy"></i>
                                <span>获奖记录</span> 
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu"> 
                                <li><a href="{{URL::route('winnerlogs.index')}}"><i class="fa fa-circle-o"></i>列表</a></li>  
                            </ul>
                        </li>   
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- =============================================== -->

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header"> 
                    <h1>@yield('title')</h1>
                    @yield('bread')
                    <ol class="breadcrumb ">
                        <li><i class="fa fa-dashboard"></i> 仪表盘</li>
                        <li class="active"> @yield('title') </li> 
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-lg-12">
                            @include('flash::message') 
                        </div>
                    </div>
                    @yield('content') 
                </section>
            </div><!-- /.content-wrapper -->

            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                </div>
            </footer>
        </div><!-- ./wrapper -->

        <!-- jQuery 1.11.3 -->
        <script src="http://cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
        <!-- jQuery UI 1.11.4 -->
        <script src="http://cdn.bootcss.com/jqueryui/1.11.4/jquery-ui.min.js"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
$.widget.bridge('uibutton', $.ui.button);
        </script>
        <!-- Bootstrap 3.3.5 -->
        <script src="http://cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script> 
        <!-- datepicker -->
        <script src="{{asset('public/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="{{asset('public/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
        <!-- Slimscroll -->
        <script src="{{asset('public/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
        <!-- FastClick -->
        <script src="{{asset('public/plugins/fastclick/fastclick.min.js')}}"></script>
        <!-- AdminLTE App -->
        <script src="{{asset('public/js/app.min.js')}}"></script>   
        <!-- Bootstrap WYSIHTML5 -->
        <script src="{{asset('public/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>   
        @yield('scripts') 
    </body>
</html>
