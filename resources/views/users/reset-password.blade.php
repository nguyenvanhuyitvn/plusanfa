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
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm ">
            <div class="container h-100">
                <div class="row align-items-center h-100">
                    <div class="col-12 mx-auto">
                        <div class="card h-100 border-primary justify-content-center">
                            <div>
                                <h2>{{ config('app.name', 'Plus Anfa') }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <main class="py-4">
            <div class="row align-items-center justify-content-md-center h-p100">
                <div class="col-lg-5 col-md-8 col-12">
                    <div class="content-top-agile bg-img" style="background-image: url({{asset('images/gallery/full/6.jpg')}})" data-overlay="4">
                        <h2>@lang('lang.common.reset_password')</h2>
                        <p class="gap-items-2 mb-20">
                            <span class="text-red">@lang('lang.users.reset_password')</span>
                        </p>
                    </div>
                    <div class="p-40 mt-10 bg-white content-bottom box-shadowed">
                        <form method="POST" action="{{ route('users.reset.password') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-danger border-danger"><i class="ti-email"></i></span>
                                    </div>
                                    <input type="text" id='email' name='email' class="form-control  @error('email') is-invalid @enderror" placeholder="{{ __('E-Mail Address') }}">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <!-- /.col -->
                                <div class="col-12 text-center">
                                <button type="submit" class="btn btn-danger-outline btn-block mt-10 btn-rounded">@lang('lang.common.submit')</button>
                                </div>
                                <!-- /.col -->
                            </div>
                        </form>	
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
