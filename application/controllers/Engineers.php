<?php defined('BASEPATH') or exit('No DIrect script access allowed');

class Engineers extends MY_Controller{

	public function __construct(){
		parent::__construct();
		$this->session->usertype == "Admin" || $this->session->usertype == "Manager" || show_404();
	}

	public function index(){
        $data['loader'] = $this->load(array(
            'datatables',
            'upload',
            'alert',
            'datepicker',
            'customjs'=> array(
                base_url('assets/ajax/main.js'),
                base_url('assets/ajax/engineer.js'))
            )
        );
        $data['page_title'] = "Engineers";
        $data['subview'] = "engineers";
        $this->load->view('mainView',$data);
    }

    public function engineer_table(){
    	$this->input->is_ajax_request() || exit("You can't access this page Directly");

        $this->cm->table_name = "engineers";
        $engineers = $this->cm->get();

        if($engineers->num_rows() > 0){
            $n = 1;
            foreach($engineers->result() as $eng){
                $result = array();
                $result[] = $n++;
                $result[] = $eng->name;
                $result[] = $eng->email;
                $result[] = $eng->phone;
                $result[] = file_exists('./uploads/'.$eng->photo) ? "<img src='".base_url('uploads/'.$eng->photo)."' width='30px' />" : "-";
                $result[] = status_switch($eng->status,"engineers/status/$eng->ID/$eng->status");
                $result[] = !file_exists('./uploads/'.$eng->document) ? "No File" :"<button type=\"button\" class=\"btn btn-info btn-sm waves-effect waves-light\" onclick='download(\"engineers\",\"".$eng->ID."\")'><i class=\"ti-download\"></i> Download</button>";
                if($this->session->usertype == "Admin"):
                $result[] = pass_change_button(base_url('engineers/change_password/'.$eng->ID))." ".view_button(base_url('engineers/single_engineer/'.$eng->ID))." ".edit_button(base_url('engineers/single_engineer/'.$eng->ID))." ".delete_button(base_url('engineers/delete/'.$eng->ID));
                elseif($this->session->usertype == "Manager"):
                $result[] = pass_change_button(base_url('engineers/change_password/'.$eng->ID))." ".view_button(base_url('engineers/single_engineer/'.$eng->ID))." ".edit_button(base_url('engineers/single_engineer/'.$eng->ID));
				endif;
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

    public function working_history($ID){
		$this->input->is_ajax_request() || exit("You can't access this page Directly");

        $this->cm->table_name = "sites";
        $this->cm->where = array('engineerID'=>$ID);
        $sites = $this->cm->get();
        if($sites->num_rows() > 0){
            $n=1;
            foreach($sites->result() as $site){
                $result = array();
                $result[] = $n++;
                $result[] = $site->name;
                $result[] = $site->address;
                $result[] = status_button($site->status);
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

    public function salary_table($ID){
		$this->input->is_ajax_request() || exit("You can't access this page Directly");

        $this->cm->table_name = "engineersalary";
        $this->cm->where = array('engineerID'=>$ID);
        $salary = $this->cm->get();
        if($salary->num_rows() > 0){
            $n=1;
            foreach($salary->result() as $sal){
                $result = array();
                $result[] = $n++;
                $result[] = $sal->salary." ৳";
                $result[] = payment_status($sal->paid,base_url('salary/give_salary_to_engineer/'.$sal->ID.'/'.$sal->paid));
                $result[] = date('F Y',strtotime($sal->date));
                if($this->session->usertype == "Admin"):
                $result[] = delete_button(base_url('salary/delete_engineer_salary/'.$sal->ID));
                endif;
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
		$this->input->is_ajax_request() || exit("You can't access this page Directly");

        $this->form_validation->set_rules('name','Name','trim|xss_clean|required');
        $this->form_validation->set_rules('email','Email','trim|xss_clean|required|valid_email|is_unique[admins.email]|is_unique[managers.email]|is_unique[engineers.email]');
        $this->form_validation->set_rules('phone','Phone','trim|xss_clean|required|is_unique[admins.phone]|is_unique[managers.phone]|is_unique[engineers.phone]');
        $this->form_validation->set_rules('address','Address','trim|xss_clean');
        $this->form_validation->set_rules('join_date','Joining Date','trim|xss_clean|required');
        $this->form_validation->set_rules('salary','Salary','trim|xss_clean|required');
        $this->form_validation->set_rules('username','Username','trim|xss_clean|required|is_unique[admins.username]|is_unique[managers.username]|is_unique[engineers.username]');
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
                'photo' => isset($filenames['photo']) ? $filenames['photo'] : "No File Selected",
                'filename' => $_FILES['document']['name'] ? $_FILES['document']['name'] : "No File Selected",
                'document' => isset($filenames['document']) ? $filenames['document'] : "No File Selected",
                'username' => $post_data['username'],
                'password' => $this->hash($post_data['password']),
            );
            if(isset($insert_data)){
                $this->cm->reset_query();
                $this->cm->table_name = "engineers";
                $insert = $this->cm->insert($insert_data);
                if($insert){
                    $this->send_success('Engineer Added Successfully');
                }else{
                    $this->send_error('Can\' Add Engineer Now, Please Try Again');
                }
            }
        }
    }

    public function single_engineer($ID = NULL,$return_type = 'json'){
        if($ID != NULL){
            $this->cm->table_name = "engineers";
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
                $this->send_error('No Engineer Found Reguarding This ID');
            }
        }else{
            $this->send_error('No Arguement Passed');
        }
    }

    public function edit($ID){
		$this->input->is_ajax_request() || exit("You can't access this page Directly");

        $eng = $this->single_engineer($ID,'array');
        $this->form_validation->set_rules('name','Name','trim|xss_clean|required');
        if($eng->email == $this->input->post('email')){
            $this->form_validation->set_rules('email','Email','trim|xss_clean|required|valid_email');
        }else{
            $this->form_validation->set_rules('email','Email','trim|xss_clean|required|valid_email|is_unique[engineers.email]');
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
            if($_FILES){
                foreach($_FILES as $key => $value){
                    $upload = $this->cm->upload($key,'./uploads/');
                    if($upload['status'] == 'success'){
                        $this->cm->delete_file('./uploads/'.$eng->$key);
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
                'photo' => isset($filenames['photo']) ? $filenames['photo'] : $eng->photo,
                'filename' => $_FILES['document']['name'] ? $_FILES['document']['name'] : $eng->filename,
                'document' => isset($filenames['document']) ? $filenames['document'] : $eng->document,
                'username' => $post_data['username'],
            );
            $this->cm->table_name = "engineers";
            $this->cm->field_name = "ID";
            $this->cm->primary_key = $eng->ID;
            if($this->cm->update($update_data)){
                $this->send_success('Engineer Updated Successfully');
            }else{
                $this->send_error('Can\' Upudate Engineer Now, Please Try Again');
            }
        }
    }

    public function change_password($ID=NULL){
		$this->input->is_ajax_request() || exit("You can't access this page Directly");

        $this->form_validation->set_rules('password','Password','trim|xss_clean|required');
        $this->form_validation->set_rules('cpassword','Confirm Password','trim|xss_clean|matches[password]');
        if($this->form_validation->run() == FALSE){
            $this->send_warning(validation_errors());
        }else{
            $post_data = $this->array_from_post(array('password'));
            $this->cm->table_name = "engineers";
            $this->cm->where = array('ID'=>$ID);
            if($this->cm->update(array('password'=>$this->hash($post_data['password'])))){
                $this->send_success('Password Changed Successfully');
            }else{
                $this->send_error('Can\'t Change Password Now, Please Try Again');
            }
        }
    }

    public function status($ID,$status){
		$this->input->is_ajax_request() || exit("You can't access this page Directly");

        switch ($status){
            case (int) 0;
                $status = (int) 1;
            break;
            case (int) 1;
                $status = (int) 0;
            break;
        }
        $status  = array('status'=>$status);
        $this->cm->table_name = "engineers";
        $this->cm->field_name = "ID";
        $this->cm->primary_key = $ID;
        if($this->cm->update($status)){
            $this->send_success('Status Updated Successfully');
        }else{
            $this->send_error('Can\' Update Status Now, Please Try Again');
        }
    }

    public function delete($ID = NULL){
    	$this->input->is_ajax_request() || exit("You can't access this page Directly");
    	$this->session->usertype == "Admin" || $this->send_error('You Dont Have Permission to Delete This');

        $this->cm->table_name = "sites";
        $this->cm->field_name = "engineerID";
        $this->cm->primary_key = $ID;
        $sites = $this->cm->get();
        if($sites->num_rows() > 0){
            $this->send_error('Engineer Was Already Added To '.$sites->num_rows().' Site So You Can\'t Delete This Enginner');
            exit;
        }

        $eng = $this->single_engineer($ID,'array');
        if($this->cm->delete_file('./uploads/'.$eng->photo) && $this->cm->delete_file('./uploads/'.$eng->document)){
            $this->cm->_table_name = "engineers";
            $this->cm->_field_name = "ID";
            $this->cm->_primary_key = $ID;
            $account_delete = $this->cm->delete();

            $this->cm->table_name = "engineersalary";
            $this->cm->field_name = "engineerID";
            $this->cm->primary_key = $ID;
            $salary_delete = $this->cm->delete();

            if($account_delete && $salary_delete){
                $this->send_success('Engineer Deleted Successfully');
            }else{
                $this->send_error('Can\'t Delete Right Now, Please Try Again');
            }
        }
    }

}
