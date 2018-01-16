<?php defined('BASEPATH') or exit('No DIrect script access allowed');

class Login extends Signin_Controller{

    public function index(){
        $this->session->userdata('loggedin') == FALSE || redirect('dashboard');
        $this->load->view('login');
    }

    public function ajax_login(){
        $this->session->userdata('loggedin') == FALSE || redirect('dashboard');
        $this->form_validation->set_rules('username','Username Or Email','trim|xss_clean|required');
        $this->form_validation->set_rules('password','Password','trim|xss_clean|required');
        if($this->form_validation->run() == FALSE){
            echo json_encode(array('status'=>'validation_error','message'=>validation_errors()));
        }else{
            $this->load->database();
            $username = $this->input->post('username');
            $password = $this->hash($this->input->post('password'));
            $tables = array('admins'=>'admins','engineers'=>'engineers','managers'=>'managers');
            foreach($tables as $table){
                $this->db->select('*');
                $this->db->from($table);
                $this->db->group_start();
                $this->db->where('username',$username);
                $this->db->or_where(array('email'=>$username,'phone'=>$username));
                $this->db->group_end();
                $this->db->where('password',$password);
                $user = $this->db->get();
                if($user->num_rows() > 0){
                    $userdata = $user->row();
                    break;
                }else{
                    $userdata = FALSE;
                }
            }
            if($userdata != FALSE){
                if($userdata->status == (int) 1){
                    $session_data = array(
                        'name' => $userdata->name,
                        'email' => $userdata->email,
                        'phone' => $userdata->phone,
                        'photo' => $userdata->photo,
                        'username' => $userdata->username,
                        'usertype' => $userdata->usertype,
                        'loggedin' => TRUE,
                    );
                    $this->session->set_userdata($session_data);
                    echo json_encode(array('status'=>'success','message'=>'Logged In Successfully, Wait Until Page Redirect','url'=> base_url('dashboard')));
                }else{
                    echo json_encode(array('status'=>'error','message'=>'Your Account Is Currently Deactivated, Please Contact To Administrator'));
                }
            }else{
                echo json_encode(array('status'=>'error','message'=>'Invalid User Credentials'));
            }
        }
    }

    public function logout(){
        $this->session->sess_destroy();
        redirect(base_url('login?Log_out_successfuly'));
    }

    protected function hash($string){
        return hash("sha512", $string . config_item("encryption_key"));
    }

}