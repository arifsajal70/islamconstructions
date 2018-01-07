<!-- Vendor JS -->
<script type="text/javascript" src="<?php echo base_url('assets/');?>vendor/jquery/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/');?>js/jquery.pageparser-0.1.3.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/');?>vendor/tether/js/tether.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/');?>vendor/bootstrap4/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/');?>vendor/detectmobilebrowser/detectmobilebrowser.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/');?>vendor/jscrollpane/jquery.mousewheel.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/');?>vendor/jscrollpane/mwheelIntent.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/');?>vendor/jscrollpane/jquery.jscrollpane.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/');?>vendor/jquery-fullscreen-plugin/jquery.fullscreen-min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/');?>vendor/waves/waves.min.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/');?>vendor/switchery/dist/switchery.min.js"></script>

<?php

    if(isset($loader) && isset($loader['js'])){
        foreach($loader['js'] as $js){
            echo $js;
        }
    }

?>

<!-- Neptune JS -->
<script type="text/javascript" src="<?php echo base_url('assets/');?>js/app.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets/');?>js/demo.js"></script>
