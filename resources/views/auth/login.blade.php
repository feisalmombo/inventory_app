<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/png" href="{{URL::asset('logintemplate/images/icons/favicon.ico')}}"/>

    <link rel="stylesheet" type="text/css" href="{{URL::asset('logintemplate/vendor/bootstrap/css/bootstrap.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{URL::asset('logintemplate/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{URL::asset('logintemplate/fonts/iconic/css/material-design-iconic-font.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{URL::asset('logintemplate/vendor/animate/animate.css')}}">

    <link rel="stylesheet" type="text/css" href="{{URL::asset('logintemplate/vendor/css-hamburgers/hamburgers.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{URL::asset('logintemplate/vendor/animsition/css/animsition.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{URL::asset('logintemplate/vendor/select2/select2.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{URL::asset('logintemplate/vendor/daterangepicker/daterangepicker.css')}}">

    <link rel="stylesheet" type="text/css" href="{{URL::asset('logintemplate/css/util.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('logintemplate/css/main.css')}}">

</head>
<body>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">

                <!-- Start form here -->
                
                <form class="login100-form validate-form"method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}

                    <span class="login100-form-logo">
                        <i class="zmdi zmdi-local-grocery-store"></i>
                    </span>

                    <span class="login100-form-title p-b-3 p-t-4">
                        Umoja ims
                    </span>

                    <div class="wrap-input100 validate-input" data-validate = "Enter username{{ $errors->has('email') ? ' has-error' : '' }}">


                        <input class="input100" id="email" type="email" name="email" placeholder="juma@gmail.com" value="{{ old('email') }}" required autofocus>
                        <span class="focus-input100" data-placeholder="&#9993;"></span>

                        @if ($errors->has('email'))
                        <span class="help-block">
                            <strong style="color: #A94442;">{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Enter password{{ $errors->has('password') ? ' has-error' : '' }}">

                        <input class="input100" id="password" type="password" name="password" placeholder="Password" required>

                        <span class="focus-input100" data-placeholder="&#xf191;"></span>

                        @if ($errors->has('password'))
                        <span class="help-block">
                            <strong style="color: #A94442;">{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="container-login100-form-btn">
                        <button type="submit" class="login100-form-btn">
                            Login
                        </button>
                    </div>
                </form>
                <!-- End form here -->

            </div>
        </div>
    </div>


    <div id="dropDownSelect1"></div>

    <script src="{{URL::asset('logintemplate/vendor/jquery/jquery-3.2.1.min.js')}}"></script>

    <script src="{{URL::asset('logintemplate/vendor/animsition/js/animsition.min.js')}}"></script>

    <script src="{{URL::asset('logintemplate/vendor/bootstrap/js/popper.js')}}"></script>

    <script src="{{URL::asset('logintemplate/vendor/bootstrap/js/bootstrap.min.js')}}"></script>

    <script src="{{URL::asset('logintemplate/vendor/select2/select2.min.js')}}"></script>

    <script src="{{URL::asset('logintemplate/vendor/daterangepicker/moment.min.js')}}"></script>

    <script src="{{URL::asset('logintemplate/vendor/daterangepicker/daterangepicker.js')}}"></script>

    <script src="{{URL::asset('logintemplate/vendor/countdowntime/countdowntime.js')}}"></script>

    <script src="{{URL::asset('logintemplate/js/main.js')}}"></script>

</body>
</html>