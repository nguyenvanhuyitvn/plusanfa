<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="http://softpro-admin-templates.websitedesignmarketingagency.com/images/favicon.ico">
    <link rel="stylesheet" href="{{asset('assets/vendor_components/fontawesome-5/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor_components/fontawesome-5/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <title>{{ config('app.name', 'PlusAnfa') }} - @yield('title')</title>
	<!-- Bootstrap 4.0-->
	<link href="{{ asset('dist/css/bootstrap.min.css') }}" rel="stylesheet">
	
	<!-- Bootstrap extend-->
  <link rel="stylesheet" href="{{asset('css/bootstrap-extend.css')}}">
	<link rel="stylesheet" href="{{asset('assets/vendor_components/font-awesome/css/font-awesome-animation.css')}}">
	<link rel="stylesheet" href="{{asset('assets/vendor_components/material-icons/css/materialdesignicons.css')}}">
	<link rel="stylesheet" href="{{asset('assets/vendor_components/Ionicons/css/ionicons.css')}}">
	<link rel="stylesheet" href="{{asset('assets/vendor_components/simple-line-icons-master/css/simple-line-icons.css')}}">
	<link rel="stylesheet" href="{{asset('assets/vendor_components/themify-icons/themify-icons.css')}}">
	<link rel="stylesheet" href="{{asset('assets/vendor_components/linea-icons/linea.css')}}">
	<link rel="stylesheet" href="{{asset('assets/vendor_components/glyphicons/glyphicon.css')}}">
	<link rel="stylesheet" href="{{asset('assets/vendor_components/flag-icon/css/flag-icon.css')}}">
	<link rel="stylesheet" href="{{asset('assets/vendor_components/simple-line-icons-master/css/simple-line-icons.css')}}">
  <link rel="stylesheet" href="{{asset('assets/vendor_components/animate/animate.css')}}">
  <link rel="stylesheet" href="{{asset('assets/vendor_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.css')}}">
  <link rel="stylesheet" href="{{asset('assets/vendor_components/bootstrap-toggle/toggle.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/vendor_components/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css')}}">
	
	<!-- theme style -->
	<link rel="stylesheet" href="{{asset('css/master_style.css')}}">
	
	<!-- SoftPro admin skins -->
	<link rel="stylesheet" href="{{asset('css/skins/_all-skins.css')}}">
  <!--alerts CSS -->
  <link rel="stylesheet" href="{{asset('assets/vendor_components/sweetalert/sweetalert.css')}}"  type="text/css">
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<script src="{{asset('assets/vendor_components/fontawesome-5/js/all.min.js')}}"></script>
  <script src="{{asset('assets/vendor_components/fontawesome-5/js/fontawesome.min.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js"></script>
  
	<![endif]-->
     
  </head>

<body class="hold-transition skin-purple-light sidebar-mini fixed">
<div class="wrapper">
  <input type="hidden" id="token" value= @if(session('token')) "{{session('token')}}" @endif >
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
          <li class="search-box">
            <a class="nav-link hidden-sm-down" href="javascript:void(0)"><i class="fa fa-search"></i></a>
            <form class="app-search" style="display: none;">
              <input type="text" class="form-control" placeholder="Search &amp; enter"> <a class="srh-btn"><i class="ti-close"></i></a>
            </form>
          </li>	  
          <!-- Messages -->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell"></i>
            </a>
            <ul class="dropdown-menu scale-up">
              <li class="header">You have 5 messages</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu inner-content-div">
                  <li><!-- start message -->
                    <a href="#">
                      <div class="pull-left">
                        <img src="../images/user2-160x160.jpg" class="rounded-circle" alt="User Image">
                      </div>
                      <div class="mail-contnet">
                          <h4>
                          Lorem Ipsum
                          <small><i class="fa fa-clock-o"></i> 15 mins</small>
                          </h4>
                          <span>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span>
                      </div>
                    </a>
                  </li>
                  <!-- end message -->
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="../images/user3-128x128.jpg" class="rounded-circle" alt="User Image">
                      </div>
                      <div class="mail-contnet">
                          <h4>
                          Nullam tempor
                          <small><i class="fa fa-clock-o"></i> 4 hours</small>
                          </h4>
                          <span>Curabitur facilisis erat quis metus congue viverra.</span>
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="../images/user4-128x128.jpg" class="rounded-circle" alt="User Image">
                      </div>
                      <div class="mail-contnet">
                          <h4>
                          Proin venenatis
                          <small><i class="fa fa-clock-o"></i> Today</small>
                          </h4>
                          <span>Vestibulum nec ligula nec quam sodales rutrum sed luctus.</span>
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="../images/user3-128x128.jpg" class="rounded-circle" alt="User Image">
                      </div>
                      <div class="mail-contnet">
                          <h4>
                          Praesent suscipit
                        <small><i class="fa fa-clock-o"></i> Yesterday</small>
                          </h4>
                          <span>Curabitur quis risus aliquet, luctus arcu nec, venenatis neque.</span>
                      </div>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="../images/user4-128x128.jpg" class="rounded-circle" alt="User Image">
                      </div>
                      <div class="mail-contnet">
                          <h4>
                          Donec tempor
                          <small><i class="fa fa-clock-o"></i> 2 days</small>
                          </h4>
                          <span>Praesent vitae tellus eget nibh lacinia pretium.</span>
                      </div>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">See all e-Mails</a></li>
            </ul>
          </li>
          <li class="dropdown user user-menu">
            <a href="#" data-toggle="control-sidebar">
              @if ($data['avatar'])
                  <img src="{{ $data['avatar'] }}" class="user-image rounded-circle b-2" alt="" width="50px" height="50px" srcset="">
              @else
                  <img src="{{ asset('images/avatar/no-avatar.png')}}" class="user-image rounded-circle b-2" alt="" width="50px" height="50px" srcset="">
              @endif
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
        <li class="active">
          <a href="{{ route('dashboard') }}">
            <i class="fa fa-tachometer"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-street-view"></i>
            <span>@lang('lang.location.location')</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('location.index')}}"><i class="fa fa-circle-thin"></i>@lang('lang.location.list')</a></li>
            <li><a href="{{route('location.create')}}"><i class="fa fa-circle-thin"></i>@lang('lang.location.add')</a></li>
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
  
  <div class="control-sidebar-bg"></div>
  
</div>
 <script src="{{asset('assets/vendor_components/moment/min/moment.min.js')}}"></script>
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
	<script src="{{asset('assets/vendor_components/popper/dist/popper.min.js')}}"></script>
	
	<!-- Bootstrap 4.0-->
    <script src="{{ asset('dist/js/bootstrap.min.js') }}" defer></script>
	
	<!-- Slimscroll -->
	<script src="{{asset('assets/vendor_components/jquery-slimscroll/jquery.slimscroll.js')}}"></script>
  <!-- Sweet-Alert  -->
  <script src="{{asset('assets/vendor_components/sweetalert/sweetalert.min.js')}}"></script>
  <script src="{{asset('assets/vendor_components/bootstrap-toggle/toggle.min.js')}}"></script>
  <script src="{{asset('assets/vendor_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js')}}"></script>
 
  <script src="{{asset('assets/vendor_components/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js')}}"></script>
	<!-- SoftPro admin App -->
  <script src="{{asset('js/template.js')}}"></script>
	
	<!-- SoftPro admin dashboard demo (This is only for demo purposes) -->
  <script src="{{asset('js/pages/dashboard2.js')}}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/ionicons/5.0.1/ionicons/ionicons.min.js"></script>

</body>
</html>
