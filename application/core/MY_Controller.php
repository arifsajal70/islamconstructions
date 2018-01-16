<?php defined('BASEPATH') or exit('No Direct script access allowed');

class MY_Controller extends CI_Controller{

    function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('security');
        $this->load->helper('button');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('Crud_Model','cm');
        $this->session->userdata('loggedin') == TRUE || redirect('login?Login_first_Than_Come');
    }

    public function load($load = array()){
        $loader = array();
        if(in_array('datatables',$load)){
            $loader['js'][] = "<script type=\"text/javascript\" src=\"".base_url('/assets/vendor/DataTables/js/jquery.dataTables.min.js')."\"></script>\n";
            $loader['js'][] = "<script type=\"text/javascript\" src=\"".base_url('/assets/vendor/DataTables/js/dataTables.bootstrap4.min.js')."\"></script>\n";
            $loader['js'][] = "<script type=\"text/javascript\" src=\"".base_url('/assets/vendor/DataTables/js/fnreload.js')."\"></script>\n";
            $loader['js'][] = "<script type=\"text/javascript\" src=\"".base_url('/assets/vendor/DataTables/Responsive/js/dataTables.responsive.min.js')."\"></script>\n";
            $loader['js'][] = "<script type=\"text/javascript\" src=\"".base_url('/assets/vendor/DataTables/Responsive/js/responsive.bootstrap4.min.js')."\"></script>\n";
            $loader['js'][] = "<script type=\"text/javascript\" src=\"".base_url('/assets/vendor/DataTables/Buttons/js/dataTables.buttons.min.js')."\"></script>\n";
            $loader['js'][] = "<script type=\"text/javascript\" src=\"".base_url('/assets/vendor/DataTables/Buttons/js/buttons.bootstrap4.min.js')."\"></script>\n";
            $loader['js'][] = "<script type=\"text/javascript\" src=\"".base_url('/assets/vendor/DataTables/JSZip/jszip.min.js')."\"></script>\n";
            $loader['js'][] = "<script type=\"text/javascript\" src=\"".base_url('/assets/vendor/DataTables/pdfmake/build/pdfmake.min.js')."\"></script>\n";
            $loader['js'][] = "<script type=\"text/javascript\" src=\"".base_url('/assets/vendor/DataTables/pdfmake/build/vfs_fonts.js')."\"></script>\n";
            $loader['js'][] = "<script type=\"text/javascript\" src=\"".base_url('/assets/vendor/DataTables/Buttons/js/buttons.html5.min.js')."\"></script>\n";
            $loader['js'][] = "<script type=\"text/javascript\" src=\"".base_url('/assets/vendor/DataTables/Buttons/js/buttons.print.min.js')."\"></script>\n";
            $loader['js'][] = "<script type=\"text/javascript\" src=\"".base_url('/assets/vendor/DataTables/Buttons/js/buttons.colVis.min.js')."\"></script>\n";
            $loader['css'][] = "<link rel=\"stylesheet\" href=\"".base_url('/assets/vendor/DataTables/css/dataTables.bootstrap4.min.css')."\"/>\n";
            $loader['css'][] = "<link rel=\"stylesheet\" href=\"".base_url('/assets/vendor/DataTables/Responsive/css/responsive.bootstrap4.min.css')."\"/>\n";
            $loader['css'][] = "<link rel=\"stylesheet\" href=\"".base_url('/assets/vendor/DataTables/Buttons/css/buttons.dataTables.min.css')."\"/>\n";
            $loader['css'][] = "<link rel=\"stylesheet\" href=\"".base_url('/assets/vendor/DataTables/Buttons/css/buttons.bootstrap4.min.css')."\"/>\n";
        }
        if(in_array('alert',$load)){
            $loader['js'][] = "<script type=\"text/javascript\" src=\"".base_url('/assets/vendor/sweetalert2/sweetalert2.min.js')."\"></script>\n";
            $loader['js'][] = "<script type=\"text/javascript\" src=\"".base_url('/assets/vendor/toastr/toastr.min.js')."\"></script>\n";
            $loader['css'][] = "<link rel=\"stylesheet\" href=\"".base_url('/assets/vendor/sweetalert2/sweetalert2.min.css')."\"/>\n";
            $loader['css'][] = "<link rel=\"stylesheet\" href=\"".base_url('/assets/vendor/toastr/toastr.min.css')."\"/>\n";
        }
        if(in_array('upload',$load)){
            $loader['js'][] = "<script type=\"text/javascript\" src=\"".base_url('/assets/vendor/dropify/dist/js/dropify.min.js')."\"></script>\n";
            $loader['css'][] = "<link rel=\"stylesheet\" href=\"".base_url('/assets/vendor/dropify/dist/css/dropify.min.css')."\"/>\n";
        }
        if(in_array('datepicker',$load)){
            $loader['js'][] = "<script type=\"text/javascript\" src=\"".base_url('/assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')."\"></script>\n";
            $loader['css'][] = "<link rel=\"stylesheet\" href=\"".base_url('/assets/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')."\"/>\n";
        }
        if(in_array('select2',$load)){
            $loader['js'][] = "<script type=\"text/javascript\" src=\"".base_url('/assets/vendor/select2/dist/js/select2.min.js')."\"></script>\n";
            $loader['css'][] = "<link rel=\"stylesheet\" href=\"".base_url('/assets/vendor/select2/dist/css/select2.min.css')."\"/>\n";
        }
        if(array_key_exists('customjs',$load)){
            if(is_array($load['customjs'])){
                foreach($load['customjs'] as $js){
                    $loader['js'][] = "<script type=\"text/javascript\" src=\"$js\"></script>\n";
                }
            }else{
                $loader['js'][] = "<script type=\"text/javascript\" src=\"".$load['customjs']."\"></script>\n";
            }
        }
        if(array_key_exists('customcss',$load)){
            if(is_array($load['customcss'])){
                foreach($load['customcss'] as $css){
                    $loader['css'][] = "<link rel=\"stylesheet\" href=\"$css\"/>\n";
                }
            }else{
                $loader['css'][] = "<link rel=\"stylesheet\" href=\"".$load['customcss']."\"/>\n";
            }
        }

        return $loader;
    }

    public function array_from_post($args = array()){
        if(is_array($args)){
            foreach($args as $key){
                $result[$key] = $this->input->post($key);
            }
            return $result;
        }else{
            echo "Invalid Arguement Supplied";
        }
    }

    public function hash($string){
        return hash("sha512", $string . config_item("encryption_key"));
    }

    public function send_success($message = NULL){
        echo json_encode(array('status'=>'success','message'=>$message));
    }

    public function send_error($message = NULL){
        echo json_encode(array('status'=>'error','message'=>$message));
    }

    public function send_warning($message = NULL){
        echo json_encode(array('status'=>'warning','message'=>$message));
    }

}