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
                            <?php echo date('Y')?> © Islam Constructions
                        </div>
                        <div class="col-sm-8 text-sm-right">
                            Powred By <a href="https://opticcoder.com" target="__blank">Optic Coder</a>
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
