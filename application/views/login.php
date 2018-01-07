<?php defined('BASEPATH') or exit('No DIrect script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Title -->
    <title>Islam Constructions</title>

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/');?>vendor/bootstrap4/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/');?>vendor/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/');?>vendor/font-awesome/css/font-awesome.min.css">

    <!-- Neptune CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/');?>css/core.css">

    <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="auth-bg">

<div class="auth">
    <div class="auth-header">
        <div class="mb-2"><img src="<?php echo base_url('assets/');?>img/logo.png" title=""></div>
        <h6>Welcome To Islam Constructions</h6>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <form>
                    <div class="form-group">
                        <div class="input-group">
                            <input type="email" class="form-control" id="exampleInputEmail" placeholder="Email">
                            <div class="input-group-addon"><i class="ti-email"></i></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <input type="password" class="form-control" id="exampleInputPassword" placeholder="Password">
                            <div class="input-group-addon"><i class="ti-key"></i></div>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="float-xs-left">
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input">
                                <span class="custom-control-indicator"></span>
                                <span class="custom-control-description font-90">Remember me</span>
                            </label>
                        </div>
                        <div class="float-xs-right">
                            <a class="text-white font-90" href="#">Forgot password?</a>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-danger btn-block">Sign in</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Vendor JS -->
<script type="text/javascript" src="<?php echo base_url('assets/');?>vendor/jquery/jquery-1.12.3.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/');?>vendor/tether/js/tether.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/');?>vendor/bootstrap4/js/bootstrap.min.js"></script>
</body>
</html>