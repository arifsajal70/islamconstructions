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
		<h6>Recover Your Password</h6>
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-4 offset-md-4">
				<form id="passResetForm">
					<div class="message"></div>
					<input type="text" name="reset_key" value="<?php echo $reset_key ;?>" style="display:none;">
					<div class="form-group">
						<div class="input-group">
							<input type="password" class="form-control" placeholder="Password" name="password">
							<div class="input-group-addon"><i class="ti-email"></i></div>
						</div>
					</div>
					<div class="form-group">
						<div class="input-group">
							<input type="password" class="form-control" placeholder="Confirm Password" name="cpassword">
							<div class="input-group-addon"><i class="ti-email"></i></div>
						</div>
					</div>
					<div class="form-group clearfix">
						<div class="float-xs-right">
							Password Remembered ?<a class="text-white font-90" href="<?php echo base_url('login');?>"> Login Now</a>
						</div>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-danger btn-block">Recover</button>
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
	$("#passResetForm").submit(function(e){
		e.preventDefault();
		jQuery.ajax({
			type: "POST",
			url: "<?php echo base_url('recover_password/set_password');?>",
			data: $(this).serialize(),
			success:function(response){
				var data = JSON.parse(response);
				if(data.status === "success"){
					$('.message').html("<div class='alert alert-success'>"+data.message+"</div>");
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
