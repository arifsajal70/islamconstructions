<?php defined('BASEPATH') or exit('No DIrect script access allowed');

class Managers extends MY_Controller{

	public function __construct(){
		parent::__construct();
	}

	public function index(){
        $data['loader'] = $this->load(array(
                'datatables',
                'upload',
                'alert',
                'datepicker',
                'customjs'=> array(
                    base_url('assets/ajax/main.js'),
                    base_url('assets/ajax/manager.js'))
            )
        );
        $data['page_title'] = "Managers";
        $data['subview'] = "managers";
        $this->load->view('mainView',$data);
    }

    public function manager_table(){
        $this->cm->table_name = "managers";
        $manager = $this->cm->get();
        if($manager->num_rows() > 0){
            $n=1;
            foreach($manager->result() as $man){
                $result = array();
                $result[] = $n++;
                $result[] = $man->name;
                $result[] = $man->email;
                $result[] = $man->phone;
                $result[] = file_exists('./uploads/'.$man->photo) ? "<img src='".base_url('uploads/'.$man->photo)."' width='30px' />" : "-";
                $result[] = $man->usertype;
                $result[] = status_switch($man->status,"managers/status/$man->ID/$man->status");
                $result[] = "<button type=\"button\" class=\"btn btn-info btn-sm waves-effect waves-light\" onclick='download(\"managers\",\"".$man->ID."\")'><i class=\"ti-download\"></i> Download</button>";
                $result[] = pass_change_button(base_url('managers/change_password/'.$man->ID))." ".view_button(base_url('managers/single_manager/'.$man->ID))." ".edit_button(base_url('managers/single_manager/'.$man->ID))." ".delete_button(base_url('managers/delete/'.$man->ID));
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

    public function site_managers($siteID){
        $this->cm->select = "sitemanagers.* , managers.* , sitemanagers.ID as smID";
        $this->cm->table_name = "sitemanagers";
        $this->cm->join = array('managers'=>'sitemanagers.managerID=managers.ID');
        $this->cm->where = array('siteID'=>$siteID);
        $sites = $this->cm->get();
        if($sites->num_rows() > 0){
            $n=1;
            foreach($sites->result() as $site){
                $result = array();
                $result[] = $n++;
                $result[] = $site->name;
                $result[] = $site->email;
                $result[] = $site->phone;
                $result[] = status_button($site->status);
                if($this->session->usertype == "Admin"):
                $result[] = delete_button(base_url('managers/delete_manager_from_site/'.$site->smID));
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
        $this->cm->table_name = "sitemanagers";
        $this->cm->join = array('sites'=>'sitemanagers.siteID=sites.ID');
        $this->cm->where = array('managerID'=>$ID);
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
        $this->cm->table_name = "managersalary";
        $this->cm->where = array('managerID'=>$ID);
        $salary = $this->cm->get();
        if($salary->num_rows() > 0){
            $n=1;
            foreach($salary->result() as $sal){
                $result = array();
                $result[] = $n++;
                $result[] = $sal->salary." ৳";
                $result[] = date('F Y',strtotime($sal->date));
                $result[] = payment_status($sal->paid,base_url('salary/give_salary_to_manager/'.$sal->ID.'/'.$sal->paid));
                $result[] = delete_button(base_url('salary/delete_manager_salary/'.$sal->ID));
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
        $this->form_validation->set_rules('email','Email','trim|xss_clean|valid_email|is_unique[admins.email]|is_unique[managers.email]|is_unique[engineers.email]');
        $this->form_validation->set_rules('phone','Phone','trim|xss_clean|required|is_unique[admins.phone]|is_unique[managers.phone]|is_unique[engineers.phone]');
        $this->form_validation->set_rules('address','Address','trim|xss_clean');
        $this->form_validation->set_rules('join_date','Join Date','trim|xss_clean|required');
        $this->form_validation->set_rules('salary','Salary','trim|xss_clean|required');
        $this->form_validation->set_rules('usertype','Working As','trim|xss_clean|required');
        $this->form_validation->set_rules('username','Username','trim|xss_clean|required|is_unique[admins.username]|is_unique[managers.username]|is_unique[engineers.username]');
        $this->form_validation->set_rules('password','Password','trim|xss_clean|required');
        $this->form_validation->set_rules('cpassword','Confirm Password','trim|xss_clean|matches[password]');

        if($this->form_validation->run() == FALSE){
            $this->send_warning(validation_errors());
        }else{
            $post_data = $this->array_from_post(array('name','email','phone','address','join_date','salary','usertype','username','password'));
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
                'usertype' => $post_data['usertype'],
                'photo' => isset($filenames['photo']) ? $filenames['photo'] : "No File Selected",
                'filename' => $_FILES['document']['name'] ? $_FILES['document']['name'] : "No FIle Selected",
                'document' => isset($filenames['document']) ? $filenames['document'] : "No File Selected",
                'username' => $post_data['username'],
                'password' => $this->hash($post_data['password']),
            );
            if(isset($insert_data)){
                $this->cm->reset_query();
                $this->cm->table_name = "managers";
                $insert = $this->cm->insert($insert_data);
                if($insert){
                    $this->send_success('Manager Added Successfully');
                }else{
                    $this->send_error('Can\' Add Manager Now, Please Try Again');
                }
            }
        }
    }

    public function add_manager_to_site($siteID=NULL){
        $this->form_validation->set_rules('managerID','Manager','trim|xss_clean|required|numeric');
        if($this->form_validation->run() == FALSE){
            $this->send_warning(validation_errors());
        }else{
            $post_data = $this->array_from_post(array('managerID'));
            $this->cm->table_name = "sitemanagers";
            $this->cm->where = array('managerID'=>$post_data['managerID'],'siteID'=>$siteID);
            $added = $this->cm->get();
            if($added->num_rows() > 0){
                $this->send_error('This Engineer Was Already Added In This Site');
                exit;
            }

            $this->cm->table_name = "sitemanagers";
            if($this->cm->insert(array('siteID'=>$siteID,'managerID'=>$post_data['managerID'],'added'=>date('Y-m-d')))){
                $this->send_success('Manager Added Tp site');
            }else{
                $this->send_error('Can\'t Add Manager To Site, Please Try Again');
            }
        }
    }

    public function single_manager($ID = NULL,$return_type = 'json'){
        if($ID != NULL){
            $this->cm->table_name = "managers";
            $this->cm->field_name = "ID";
            $this->cm->primary_key = $ID;
            $managers = $this->cm->get();
            if($managers->num_rows() == (int) 1){
                foreach($managers->result() as $key => $value){
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
                $this->send_error('No Manager Found Reguarding This ID');
            }
        }else{
            $this->send_error('No Arguement Passed');
        }
    }

    public function edit($ID){
        $man = $this->single_manager($ID,'array');
        $this->form_validation->set_rules('name','Name','trim|xss_clean|required');
        if($man->email == $this->input->post('email')):
            $this->form_validation->set_rules('email','Email','trim|xss_clean|valid_email');
        else:
            $this->form_validation->set_rules('email','Email','trim|xss_clean|valid_email|is_unique[admins.email]|is_unique[managers.email]|is_unique[engineers.email');
        endif;
        if($man->phone == $this->input->post('phone')):
            $this->form_validation->set_rules('phone','Phone','trim|xss_clean|required');
        else:
            $this->form_validation->set_rules('phone','Phone','trim|xss_clean|required|is_unique[admins.phone]|is_unique[managers.phone]|is_unique[engineers.phone]');
        endif;
        $this->form_validation->set_rules('address','Address','trim|xss_clean');
        $this->form_validation->set_rules('join_date','Joining Date','trim|xss_clean|required');
        $this->form_validation->set_rules('salary','Salary','trim|xss_clean|required');
        $this->form_validation->set_rules('usertype','Working As','trim|xss_clean|required');
        $this->form_validation->set_rules('username','Username','trim|xss_clean|required');
        if($this->form_validation->run() == FALSE){
            $this->send_warning(validation_errors());
        }else{
            $post_data = $this->array_from_post(array('name','email','phone','address','join_date','salary','usertype','username'));
            if($_FILES){
                foreach($_FILES as $key => $value){
                    $upload = $this->cm->upload($key,'./uploads/');
                    if($upload['status'] == 'success'){
                        $this->cm->delete_file('./uploads/'.$man->$key);
                        $filenames[$key] = $upload['file_name'];
                        $name[$key]['filename'] = $_FILES[$key]['name'];
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
                'usertype' => $post_data['usertype'],
                'photo' => isset($filenames['photo']) ? $filenames['photo'] : "$man->photo",
                'filename' => $_FILES['document']['name'] ? $_FILES['document']['name'] : $man->filename,
                'document' => isset($filenames['document']) ? $filenames['document'] : $man->document,
                'username' => $post_data['username'],
            );
            $this->cm->table_name = "managers";
            $this->cm->field_name = "ID";
            $this->cm->primary_key = $man->ID;
            if($this->cm->update($update_data)){
                $this->send_success('Manager Updated Successfully');
            }else{
                $this->send_error('Can\' Update Manager Now, Please Try Again');
            }
        }
    }

    public function change_password($ID){
        $this->form_validation->set_rules('password','Password','trim|xss_clean|required');
        $this->form_validation->set_rules('cpassword','Confirm Password','trim|xss_clean|required|matches[password]');
        if($this->form_validation->run() == FALSE){
            $this->send_warning(validation_errors());
        }else{
            $post_data = $this->array_from_post(array('password'));
            $this->cm->table_name = 'managers';
            $this->cm->where = array('ID'=>$ID);
            if($this->cm->update(array('password'=>$this->hash($post_data['password'])))){
                $this->send_success('Password Changed Successfully');
            }else{
                $this->send_error('Can\'t Change Password Now, Please Try Again');
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
        $this->cm->table_name = "managers";
        $this->cm->field_name = "ID";
        $this->cm->primary_key = $ID;
        if($this->cm->update($status)){
            $this->send_success('Status Updated Successfully');
        }else{
            $this->send_error('Can\' Update Status Now, Please Try Again');
        }
    }

    public function delete($ID = NULL){
        $this->cm->table_name = "sitemanagers";
        $this->cm->where = array('managerID'=>$ID);
        $sites = $this->cm->get();
        if($sites->num_rows() > 0){
            $this->send_error("Engineer Was Already Added To ".$sites->num_rows()." Site So You Can't Delete This Enginner");
            exit;
        }
        $this->cm->reset_query();
        $man = $this->single_manager($ID,'array');
        if($this->cm->delete_file('./uploads/'.$man->photo) && $this->cm->delete_file('./uploads/'.$man->document)){
            $this->cm->reset_query();
            $this->cm->table_name = "managers";
            $this->cm->field_name = "ID";
            $this->cm->primary_key = $ID;
            $delete_account = $this->cm->delete();
            $this->cm->reset_query();
            $this->cm->table_name = "managersalary";
            $this->cm->field_name = "managerID";
            $this->cm->primary_key = $ID;
            $delete_salary_statement = $this->cm->delete();
            if($delete_account && $delete_salary_statement){
                $this->send_success('Manager Deleted Successfully');
            }else{
                $this->send_error('Can\'t Delete Right Now, Please Try Again');
            }
        }else{
            $this->send_error('Can\' Delete Files');
        }
    }

    public function delete_manager_from_site($ID){
        $this->cm->table_name = "sitemanagers";
        $this->cm->where = array('ID'=>$ID);
        $site = $this->cm->get()->row();
		$this->check_site_status($site->siteID);
		$this->cm->reset_query();
        $this->cm->table_name = "sitemanagers";
        $this->cm->where = array('ID'=>$ID);
        if($this->cm->delete()){
            $this->send_success('Manager Deleted From Site Successfully');
        }else{
            $this->send_error('Can\'t Delete Manager From Site, Please Try Again');
        }
    }

}
