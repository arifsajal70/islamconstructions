<?php defined('BASEPATH') or exit('No DIrect script access allowed');

class Admins extends MY_Controller{

    public function index(){
        $data['loader'] = $this->load(array(
                'datatables',
                'upload',
                'alert',
                'datepicker',
                'select2',
                'customjs'=> array(
                    base_url('assets/ajax/main.js'),
                    base_url('assets/ajax/admin.js'))
            )
        );
        $data['page_title'] = "Admins";
        $data['subview'] = "admins";
        $this->load->view('mainView',$data);
    }

    public function admin_table(){
        $this->cm->table_name = "admins";
        $admin = $this->cm->get();
        if($admin->num_rows() > 0){
            $n=1;
            foreach($admin->result() as $admin){
                $result = array();
                $result[] = $n++;
                $result[] = $admin->name;
                $result[] = $admin->email;
                $result[] = $admin->phone;
                $result[] = file_exists('./uploads/'.$admin->photo) ? "<img src='".base_url('uploads/'.$admin->photo)."' width='30px' />" : "-";
                $result[] = status_switch($admin->status,"admins/status/$admin->ID/$admin->status");
                $result[] = view_button(base_url('admins/single_admin/'.$admin->ID))." ".edit_button(base_url('admins/single_admin/'.$admin->ID))." ".delete_button(base_url('admins/delete/'.$admin->ID));
                $table['data'][] = $result;
            }
            echo json_encode($table);
        }else{
            echo '{
				"sEcho": 1,
				"iTotalRecords": "0",
				"iTotalDisplayRecords": "0",
				"aaData": []
			}';
        }
    }

    public function add(){
        $this->form_validation->set_rules('name','Name','trim|xss_clean|required');
        $this->form_validation->set_rules('email','Email','trim|xss_clean|required|valid_email|is_unique[admins.email]');
        $this->form_validation->set_rules('phone','Phone','trim|xss_clean|required');
        $this->form_validation->set_rules('address','Address','trim|xss_clean');
        $this->form_validation->set_rules('join_date','Joining Date','trim|xss_clean|required');
        $this->form_validation->set_rules('salary','Salary','trim|xss_clean|required');
        $this->form_validation->set_rules('username','Username','trim|xss_clean|required');
        $this->form_validation->set_rules('password','Password','trim|xss_clean|required');
        $this->form_validation->set_rules('cpassword','Confirm Password','trim|xss_clean|matches[password]');

        if($this->form_validation->run() == FALSE){
            $this->send_warning(validation_errors());
        }else{
            $post_data = $this->array_from_post(array('name','email','phone','address','join_date','salary','username','password'));
            if($_FILES){
                foreach($_FILES as $key => $value){
                    $upload = $this->cm->upload($key,'./uploads/');
                    if($upload['status'] == 'success'){
                        $filenames[$key] = $upload['file_name'];
                    }else{
                        $filenames[$key] = $upload['error'];
                    }
                }
            }
            $insert_data = array(
                'name' => $post_data['name'],
                'email' => $post_data['email'],
                'phone' => $post_data['phone'],
                'address' => $post_data['address'],
                'join_date' => $post_data['join_date'],
                'salary' => $post_data['salary'],
                'photo' => $filenames['photo'],
                'document' => $filenames['document'],
                'username' => $post_data['username'],
                'password' => $this->hash($post_data['password']),
            );
            if(isset($insert_data)){
                $this->cm->reset_query();
                $this->cm->table_name = "admins";
                $insert = $this->cm->insert($insert_data);
                if($insert){
                    $this->send_success('Admin Added Successfully');
                }else{
                    $this->send_error('Can\' Add Admin Now, Please Try Again');
                }
            }
        }
    }

    public function single_admin($ID = NULL,$return_type = 'json'){
        if($ID != NULL){
            $this->cm->table_name = "admins";
            $this->cm->field_name = "ID";
            $this->cm->primary_key = $ID;
            $engineers = $this->cm->get();
            if($engineers->num_rows() == (int) 1){
                foreach($engineers->result() as $key => $value){
                    $result[$key] = $value;
                }
                if($return_type == 'json'){
                    $this->send_success(json_encode($result));
                }elseif($return_type == 'array'){
                    return json_decode(json_encode($result[0]));
                }else{
                    $this->send_error('Invalid Return Type Passed');
                }
            }else{
                $this->send_error('No Admin Found Reguarding This ID');
            }
        }else{
            $this->send_error('No Arguement Passed');
        }
    }

    public function edit($ID){
        $eng = $this->single_admin($ID,'array');
        $this->form_validation->set_rules('name','Name','trim|xss_clean|required');
        if($eng->email == $this->input->post('email')){
            $this->form_validation->set_rules('email','Email','trim|xss_clean|required|valid_email');
        }else{
            $this->form_validation->set_rules('email','Email','trim|xss_clean|required|valid_email|is_unique[admins.email]');
        }
        $this->form_validation->set_rules('phone','Phone','trim|xss_clean|required');
        $this->form_validation->set_rules('address','Address','trim|xss_clean');
        $this->form_validation->set_rules('join_date','Joining Date','trim|xss_clean|required');
        $this->form_validation->set_rules('salary','Salary','trim|xss_clean|required');
        $this->form_validation->set_rules('username','Username','trim|xss_clean|required');
        if($this->form_validation->run() == FALSE){
            $this->send_warning(validation_errors());
        }else{
            $post_data = $this->array_from_post(array('name','email','phone','address','join_date','salary','username'));
            $filenames['photo'] = $eng->photo;
            $filenames['document'] = $eng->document;
            if($_FILES){
                foreach($_FILES as $key => $value){
                    $upload = $this->cm->upload($key,'./uploads/');
                    if($upload['status'] == 'success'){
                        $this->cm->delete_file('./uploads/'.$filenames[$key]);
                        $filenames[$key] = $upload['file_name'];
                    }
                }
            }
            $update_data = array(
                'name' => $post_data['name'],
                'email' => $post_data['email'],
                'phone' => $post_data['phone'],
                'address' => $post_data['address'],
                'join_date' => $post_data['join_date'],
                'salary' => $post_data['salary'],
                'photo' => $filenames['photo'],
                'document' => $filenames['document'],
                'username' => $post_data['username'],
            );
            $this->cm->table_name = "admins";
            $this->cm->field_name = "ID";
            $this->cm->primary_key = $eng->ID;
            if($this->cm->update($update_data)){
                $this->send_success('Admin Updated Successfully');
            }else{
                $this->send_error('Can\' Upudate Admin Now, Please Try Again');
            }
        }
    }

    public function status($ID,$status){
        switch ($status){
            case (int) 0;
                $status = (int) 1;
                break;
            case (int) 1;
                $status = (int) 0;
                break;
        }
        $status  = array('status'=>$status);
        $this->cm->table_name = "admins";
        $this->cm->field_name = "ID";
        $this->cm->primary_key = $ID;
        if($this->cm->update($status)){
            $this->send_success('Status Updated Successfully');
        }else{
            $this->send_error('Can\' Update Status Now, Please Try Again');
        }
    }

    public function delete($ID = NULL){
        $eng = $this->single_admin($ID,'array');
        if($this->cm->delete_file('./uploads/'.$eng->photo) && $this->cm->delete_file('./uploads/'.$eng->document)){
            $this->cm->_table_name = "admins";
            $this->cm->_field_name = "ID";
            $this->cm->_primary_key = $ID;
            if($this->cm->delete()){
                $this->send_success('Admin Deleted Successfully');
            }else{
                $this->send_error('Can\'t Delete Right Now, Please Try Again');
            }
        }
    }

}