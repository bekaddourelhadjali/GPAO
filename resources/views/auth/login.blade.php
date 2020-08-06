<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
  <link  href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet"> 
   <link  href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href=" {{asset('css/font-awesome.min.css')}} " rel="stylesheet" type="text/css">
    <style>

        .nav-item{
            display: inline-block;
            list-style: none;
            font-size: 150%;


        }

        .nav-ul{
            position: absolute;
            right : -9%;
            top : 35%;
        }
        .header_main{
            top:-60px;

        }
        input{
            border-radius:10rem !important; 
            font-size:15rem;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="{{asset('css/shop_styles.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/jquery-ui.css')}}">
    @yield('style')
</head>
<body class="bg-gradient-primary">
 
<div class="container">
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">

                <div class="card-body p-0">
                <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image" style="background-size: contain"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Bienvenue!</h1>
                  </div>
                    <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                        {{csrf_field()}}

                        <div class="form-group ">
                        <input type="username" name="username" value="{{ old('username') }}"  class="  form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" aria-describedby="usernameHelp" id="username" aria-describedby="usernameHelp" placeholder="Username" required autofocus>

                                @if ($errors->has('username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            
                        </div>

                        <div class="form-group "> 
                                <input id="password" type="password" class="  form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" minlength="8" required placeholder="password">

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            
                        </div>
                        <div class="form-group" style="vertical-align:middle;" >

                    </div> 

                         
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    {{ __('Login') }}
                                </button>

                                <br><br><br><br><br><br><br><br>
                                <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; GPAO {{date('Y')}}</span>
          </div>
        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
    </div>
</div><script src="{{asset('js/jquery.min.js')}}"></script>

<script src="{{asset('js/custom.js')}}"></script>
<script src="{{asset('js/jquery-ui.js')}}"></script>
<script src="{{asset('js/shop_custom.js')}}"></script>
<!-- Custom scripts for all pages-->
<script src="{{asset('js/sb-admin-2.min.js')}} "></script>
@yield('script')
</body>
</html>