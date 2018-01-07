<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('compo/head');?>
<body class="fixed-sidebar fixed-header content-appear skin-default">
<div class="wrapper" id="mainView">

    <div id="contentView">
        <!-- Preloader -->
        <div class="preloader"></div>

        <!-- Sidebar -->
        <div class="site-overlay"></div>

        <?php $this->load->view('compo/menu');?>

        <!-- Sidebar second -->
        <?php $this->load->view('compo/sidebar');?>

        <!-- Header -->
        <?php $this->load->view('compo/header');?>

        <div class="site-content">
            <!-- Content -->
            <div class="content-area py-1">
                <div class="container-fluid">
                    <?php isset($subview) ? $this->load->view('pages/'.$subview) : NULL ;?>
                </div>
            </div>
            <!-- Footer -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-xs-center">
                        <div class="col-sm-4 text-sm-left mb-0-5 mb-sm-0">
                            2016 © Islam Constructions
                        </div>
                        <div class="col-sm-8 text-sm-right">
                            <ul class="nav nav-inline l-h-2">
                                <li class="nav-item"><a class="nav-link text-black" href="#">Privacy</a></li>
                                <li class="nav-item"><a class="nav-link text-black" href="#">Terms</a></li>
                                <li class="nav-item"><a class="nav-link text-black" href="#">Help</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>

    </div>

</div>

<?php $this->load->view('compo/scripts');?>
</body>
</html>