<?php defined('BASEPATH') or exit('No DIrect script access allowed');?>
<head>
    <!-- Meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Title -->
    <title><?= $page_title ;?></title>

    <link rel="icon" href="<?php echo base_url('uploads/system/icon-white.png')?>">
    <!-- Vendor CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/');?>vendor/bootstrap4/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/');?>vendor/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/');?>vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/');?>vendor/animate.css/animate.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/');?>vendor/jscrollpane/jquery.jscrollpane.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/');?>vendor/waves/waves.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/');?>vendor/switchery/dist/switchery.min.css">
    <?php
        if(isset($loader) && isset($loader['css'])){
            foreach($loader['css'] as $css){
                echo $css;
            }
        }
    ?>
	<link rel="stylesheet" href="<?php echo base_url('assets/');?>css/core.css">
    <script>
        window.baseUrl = "<?php echo base_url();?>";
    </script>
</head>
