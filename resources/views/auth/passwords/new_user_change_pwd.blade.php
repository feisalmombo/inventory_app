<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/png" href="../logintemplate/images/icons/favicon.ico"/>

    <link rel="stylesheet" type="text/css" href="../logintemplate/vendor/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="../logintemplate/fonts/font-awesome-4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="../logintemplate/fonts/iconic/css/material-design-iconic-font.min.css">

    <link rel="stylesheet" type="text/css" href="../logintemplate/vendor/animate/animate.css">

    <link rel="stylesheet" type="text/css" href="../logintemplate/vendor/css-hamburgers/hamburgers.min.css">

    <link rel="stylesheet" type="text/css" href="../logintemplate/vendor/animsition/css/animsition.min.css">

    <link rel="stylesheet" type="text/css" href="../logintemplate/vendor/select2/select2.min.css">

    <link rel="stylesheet" type="text/css" href="../logintemplate/vendor/daterangepicker/daterangepicker.css">

    <link rel="stylesheet" type="text/css" href="../logintemplate/css/util.css">
    <link rel="stylesheet" type="text/css" href="../logintemplate/css/main.css">

</head>
<body>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">

                <!-- Start form here -->
                
                <form class="login100-form validate-form"method="POST" action="{{ url('/change_password') }}">
                {{ csrf_field() }}

                <h8 style="text-align: center;">@include('msgs.success')</h8>

                <span class="login100-form-logo">
                    <i class="zmdi zmdi-local-grocery-store"></i>
                </span>

                    <span class="login100-form-title p-b-3 p-t-4">
                        Umoja ims
                    </span>

                    <div class="wrap-input100 validate-input">

                         <input class="input100" type="password" name="old_password" placeholder="Old Password" required="required">

                         <span class="focus-input100" data-placeholder="&#xf191;"></span>
                    </div>

                    <div class="wrap-input100 validate-input">

                        <input class="input100" type="password" name="new_password" placeholder="New Password" required="required">

                        <span class="focus-input100" data-placeholder="&#xf191;"></span>
                    </div>


                    <div class="wrap-input100 validate-input">

                        <input class="input100" type="password" name="conf_password" placeholder="Confirm New Password" required="required">

                        <span class="focus-input100" data-placeholder="&#xf191;"></span>
                        </div>

                    <div class="container-login100-form-btn">
                        <button type="submit" class="login100-form-btn" value="Login">
                           Change Password
                        </button>
                    </div>
                </form>
                <!-- End form here -->

            </div>
        </div>
    </div>


    <div id="dropDownSelect1"></div>

    <script src="../logintemplate/vendor/jquery/jquery-3.2.1.min.js"></script>

    <script src="../logintemplate/vendor/animsition/js/animsition.min.js"></script>

    <script src="../logintemplate/vendor/bootstrap/js/popper.js"></script>

    <script src="../logintemplate/vendor/bootstrap/js/bootstrap.min.js"></script>

    <script src="../logintemplate/vendor/select2/select2.min.js"></script>

    <script src="../logintemplate/vendor/daterangepicker/moment.min.js"></script>

    <script src="../logintemplate/vendor/daterangepicker/daterangepicker.js"></script>

    <script src="../logintemplate/vendor/countdowntime/countdowntime.js"></script>

    <script src="../logintemplate/js/main.js"></script>

</body>
</html>