<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  
<!-- Mirrored from softpro-admin-templates.websitedesignmarketingagency.com/main/index2.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 24 Mar 2020 06:09:05 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="http://softpro-admin-templates.websitedesignmarketingagency.com/images/favicon.ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>{{ config('app.name', 'PlusAnfa') }} - @yield('title')</title>
	<!-- Bootstrap 4.0-->
	<link href="{{ asset('dist/css/bootstrap.min.css') }}" rel="stylesheet">
	
	<!-- Bootstrap extend-->
	<link rel="stylesheet" href="{{asset('css/bootstrap-extend.css')}}">
	
	<!-- theme style -->
	<link rel="stylesheet" href="{{asset('css/master_style.css')}}">
	
	<!-- SoftPro admin skins -->
	<link rel="stylesheet" href="{{asset('css/skins/_all-skins.css')}}">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
     
  </head>

<body class="hold-transition skin-purple-light sidebar-mini fixed">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
  <a href="#" class="logo">
      <!-- mini logo -->
	  <b class="logo-mini">
          {{-- <span class="light-logo"><img src="{{asset('images/logo/logo_com.png')}}" width="30px" height="30px" alt="logo"></span> --}}
          <span class="light-logo"><img src="{{asset('images/logo-light.png')}}" alt="logo"></span>
	  </b>
      <!-- logo-->
      <span class="logo-lg">
		  <img src="{{asset('images/logo-light-text.png')}}" alt="logo" class="light-logo">
	  </span>
    </a>
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top">
	  	
      <!-- Sidebar toggle button-->
		  <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
			<span class="sr-only">Toggle navigation</span>
		  </a>	
		
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
		  <!-- User Account-->
          <li class="dropdown user user-menu">
            <a href="#" data-toggle="control-sidebar">
              <img src="{{$data['avatar']}}" class="user-image rounded-circle b-2" alt="User Image">
            <span class="font-size-14">{{$data['full_name']}}</span>
            </a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">
      
      <!-- sidebar menu-->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header nav-small-cap">CONTROL PANEL</li>
        <li class="treeview active">
          <a href="#">
            <i class="fa fa-tachometer"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="mdi mdi-apps"></i>
            <span>App</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/app-chat.html"><i class="fa fa-circle-thin"></i>Chat app</a></li>
            <li><a href="pages/app-contact.html"><i class="fa fa-circle-thin"></i>Contact / Employee</a></li>
			<li><a href="pages/app-calendar.html"><i class="fa fa-circle-thin"></i>Calendar</a></li>
            <li><a href="pages/app-profile.html"><i class="fa fa-circle-thin"></i>Profile</a></li>
            <li><a href="pages/app-userlist-grid.html"><i class="fa fa-circle-thin"></i>Userlist Grid</a></li>
          </ul>
        </li>
      </ul>
    </section>
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	  
    <!-- Main content -->
    <section class="content">
		@yield('content')
	</section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right d-none d-sm-inline-block">
        <ul class="nav nav-primary nav-dotted nav-dot-separated justify-content-center justify-content-md-end">
		  <li class="nav-item">
			<a class="nav-link" href="javascript:void(0)">FAQ</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" href="#">Purchase Now</a>
		  </li>
		</ul>
    </div>
	  &copy; 2018 <a href="#">Plus Anfa- Smart Solution</a>. All Rights Reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-light">
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane active" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Account</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-sliders bg-primary"></i>
              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Settings</h4>
              </div>
            </a>
          </li>
          <li>
              <a href="{{route('users.index')}}">
              <i class="menu-icon fa fa-user bg-info"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Infomations</h4>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-key bg-warning"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Reset Password</h4>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:;" onclick="document.getElementById('logout').submit()">
              <form action="{{route('logout')}}" id='logout' method="post">
                @csrf
                <i class="menu-icon fa fa-sign-out bg-danger"></i>
                <div class="menu-info">
                  <h4 class="control-sidebar-subheading">
                    Logout
                  </h4>
                </div>
              </form>
             </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  
  <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
  
</div>
<!-- ./wrapper -->
  	
	 
	  
	<!-- jQuery 3 -->
	<script src="{{asset('assets/vendor_components/jquery-3.3.1/jquery-3.3.1.js')}}"></script>
	
	<!-- fullscreen -->
	<script src="{{asset('assets/vendor_components/screenfull/screenfull.js')}}"></script>
	
	<!-- jQuery UI 1.11.4 -->
	<script src="{{asset('assets/vendor_components/jquery-ui/jquery-ui.js')}}"></script>
	
	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
	<script>
	  $.widget.bridge('uibutton', $.ui.button);
	</script>
	
	<!-- popper -->
	<script src="{{asset('assets/vendor_components/popper/dist/popper.min.')}}"></script>
	
	<!-- Bootstrap 4.0-->
    <script src="{{ asset('dist/js/bootstrap.min.js') }}" defer></script>
	
	<!-- Slimscroll -->
	<script src="{{asset('assets/vendor_components/jquery-slimscroll/jquery.slimscroll.js')}}"></script>
	
	<!-- FastClick -->
	<script src="{{asset('assets/vendor_components/fastclick/lib/fastclick.js')}}"></script>
	
	<!-- ChartJS -->
	<script src="{{asset('assets/vendor_components/chart.js-master/Chart.min.js')}}"></script>
	
	<!-- amchart js -->
  <script src="{{asset('assets/vendor_components/amchart/js/amcharts.js')}}"></script>
  <script src="{{asset('assets/vendor_components/amchart/js/serial.')}}"></script>
  <script src="{{asset('assets/vendor_components/amchart/js/light.js')}}"></script>

		
	<!-- SoftPro admin App -->
    <script src="{{asset('js/template.js')}}"></script>
	
	<!-- SoftPro admin dashboard demo (This is only for demo purposes) -->
    <script src="{{asset('js/pages/dashboard2.js')}}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/ionicons/5.0.1/ionicons/ionicons.min.js"></script>
</body>

<!-- Mirrored from softpro-admin-templates.websitedesignmarketingagency.com/main/index2.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 24 Mar 2020 06:09:51 GMT -->
</html>
