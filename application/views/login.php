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

    <link rel="icon" href="<?php echo base_url('uploads/system/icon-white.png')?>">

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
        <div class="mb-2"><img width="30%" src="<?php echo base_url('uploads/system/logo-white.png');?>" title=""></div>
        <h6>Welcome To Islam Constructions</h6>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 offset-md-4">
                <form id="signinForm">
                    <div class="message"></div>
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Username Or Email" name="username">
                            <div class="input-group-addon"><i class="ti-email"></i></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <input type="password" class="form-control" placeholder="Password" name="password">
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
                            <a class="text-white font-90" href="<?php echo base_url('forget_password')?>">Forgot password?</a>
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
<script type="text/javascript" src="<?php echo base_url('assets/');?>vendor/jquery/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/');?>vendor/tether/js/tether.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/');?>vendor/bootstrap4/js/bootstrap.min.js"></script>
<script>
    $("#signinForm").submit(function(e){
        e.preventDefault();
        jQuery.ajax({
            type: "POST",
            url: "<?php echo base_url('login/ajax_login');?>",
            data: $(this).serialize(),
            success:function(response){
                var data = JSON.parse(response);
                if(data.status === "success"){
                    $('.message').html("<div class='alert alert-success'>"+data.message+"</div>");
                    setTimeout(function(){
                        window.location = data.url;
                    },2000)
                }else if(data.status === "error"){
                    $('.message').html("<div class='alert alert-danger'>"+data.message+"</div>");
                }else if(data.status === "validation_error"){
                    $('.message').html("<div class='alert alert-warning'>"+data.message+"</div>");
                }
            }
        });
    });
</script>
</body>
</html>
