<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

  
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
     <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Bootstrap extend-->
    <link rel="stylesheet" href="{{asset('css/bootstrap-extend.css')}}">
        
    <!-- theme style -->
    <link rel="stylesheet" href="{{asset('css/master_style.css')}}">

    <!-- SoftPro admin skins -->
    <link rel="stylesheet" href="{{asset('css/skins/_all-skins.css')}}">
   
    <!-- SoftPro admin skins -->
    <link rel="stylesheet" href="{{asset('css/skins/_all-skins.css')}}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <h2>{{ config('app.name', 'Plus Anfa') }}</h2>
                </a>
            </div>
        </nav>
        <main class="py-4">
            <div class="row align-items-center justify-content-md-center h-p100">
                        
                <div class="col-lg-5 col-md-8 col-12">
                    <div class="content-top-agile bg-img" style="background-image: url({{asset('images/gallery/full/6.jpg')}})" data-overlay="4">
                        <h2>Login With</h2>
                        <p class="gap-items-2 mb-20">
                            <a class="btn btn-social-icon btn-outline btn-white" href="#"><i class="fa fa-facebook"></i></a>
                            <a class="btn btn-social-icon btn-outline btn-white" href="#"><i class="fa fa-twitter"></i></a>
                            <a class="btn btn-social-icon btn-outline btn-white" href="#"><i class="fa fa-google-plus"></i></a>
                            <a class="btn btn-social-icon btn-outline btn-white" href="#"><i class="fa fa-instagram"></i></a>
                        </p>
                    </div>
                    <div class="p-40 mt-10 bg-white content-bottom box-shadowed">
                        <form method="POST" action="{{ route('login') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-danger border-danger"><i class="ti-user"></i></span>
                                    </div>
                                    <input type="text" id='email' name='email' class="form-control  @error('email') is-invalid @enderror" placeholder="{{ __('E-Mail Address') }}">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-danger border-danger"><i class="ti-lock"></i></span>
                                    </div>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="{{ __('Password') }}">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                <div class="checkbox">
                                    <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label for="remember">@lang('lang.common.remember')</label>
                                </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-6">
                                <div class="fog-pwd text-right">
                                    <a href="javascript:void(0)"><i class="fa fa-lock"></i> @lang('lang.common.forgot_password')</a><br>
                                </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-12 text-center">
                                <button type="submit" class="btn btn-danger-outline btn-block mt-10 btn-rounded">@lang('lang.common.sign_in')</button>
                                </div>
                                <!-- /.col -->
                            </div>
                        </form>	
                        <div class="text-center mt-20">
                        <p class="mb-0">@lang('lang.common.dont_you_have_an_account') <a href="{{route('register')}}" class="text-info ml-5">@lang('lang.common.sign_up')</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
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
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>
<script src="{{ asset('dist/js/bootstrap.min.js') }}" defer></script>
<!-- popper -->
<script src="{{asset('assets/vendor_components/popper/dist/popper.min.')}}"></script>
<!-- SoftPro admin App -->
<script src="{{asset('js/template.js')}}"></script>
</body>
</html>
