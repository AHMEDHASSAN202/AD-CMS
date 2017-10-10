<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sign In | Bootstrap Based Admin Template - Material Design</title>
    <!-- Favicon-->
    <link rel="icon" href="<?php echo assets('admin/images/favicon.ico'); ?>" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="<?php echo assets('plugins/bootstrap/css/bootstrap.css');?>" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="<?php echo assets('plugins/node-waves/waves.css'); ?>" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="<?php echo assets('plugins/animate-css/animate.css'); ?>" rel="stylesheet" />

    <!-- Style Css -->
    <link href="<?php echo assets('admin/css/style.css'); ?>" rel="stylesheet">

    <!-- Custom Css -->
    <link href="<?php echo assets('admin/css/login.css'); ?>" rel="stylesheet">
</head>

<body class="login-page">
<div class="login-box">
    <div class="logo">
        <a href="javascript:void(0);">AD<b>CMS</b></a>
        <small>Powerful Admin Panel</small>
    </div>
    <div class="card">
        <div class="body">
            <form id="sign_in" action="<?php echo $action; ?>" method="POST">
                <div class="msg">Sign in to start your session</div>
                <div class="result" id="result"></div>
                <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">email</i>
                        </span>
                    <div class="form-line">
                        <input id="email" type="email" minlength="5" class="form-control" name="email" placeholder="Email" required autofocus autocomplete="off">
                    </div>
                </div>
                <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                    <div class="form-line">
                        <input id="password" type="password" minlength="5" class="form-control" name="password" placeholder="Password" required autocomplete="off">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-8 p-t-5">
                        <input type="checkbox" name="rememberMe" id="rememberme" class="filled-in chk-col-pink">
                        <label for="rememberme">Remember Me</label>
                    </div>
                    <div class="col-xs-4">
                        <button id="submit" class="btn btn-block bg-pink waves-effect" type="submit">SIGN IN</button>
                    </div>
                </div>
                <div class="row m-t-15 m-b--20">
                    <div class="col-xs-6">
                        <a href="sign-up.html">Register Now!</a>
                    </div>
                    <div class="col-xs-6 align-right">
                        <a href="forgot-password.html">Forgot Password?</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Jquery Core Js -->
<script src="<?php echo assets('plugins/jquery/jquery.min.js'); ?>"></script>

<!-- Bootstrap Core Js -->
<script src="<?php echo assets('plugins/bootstrap/js/bootstrap.js'); ?>"></script>

<!-- Waves Effect Plugin Js -->
<script src="<?php echo assets('plugins/node-waves/waves.js'); ?>"></script>

<!-- Custom Js -->
<script src="<?php echo assets('admin/js/admin.js'); ?>"></script>
<script src="<?php echo assets('admin/js/login.js'); ?>"></script>
</body>

</html>