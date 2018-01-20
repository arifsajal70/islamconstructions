<?php defined('BASEPATH') or exit('No DIrect script access allowed');

class Employees extends MY_Controller{

    public function index(){
        $data['loader'] = $this->load(array(
                'datatables',
                'upload',
                'alert',
                'datepicker',
                'select2',
                'customjs'=> array(
                    base_url('assets/ajax/main.js'),
                    base_url('assets/ajax/employee.js'))
            )
        );
        $data['page_title'] = "Employees";
        $data['subview'] = "employees";
        $this->load->view('mainView',$data);
    }

    public function employee_table(){
        $this->cm->table_name = "employees";
        $employee = $this->cm->get();
        if($employee->num_rows() > 0){
            $n=1;
            foreach($employee->result() as $emp){
                $result = array();
                $result[] = $n++;
                $result[] = $emp->name;
                $result[] = $emp->email;
                $result[] = $emp->phone;
                $result[] = file_exists('./uploads/'.$emp->photo) ? "<img src='".base_url('uploads/'.$emp->photo)."' width='30px' />" : "-";
                $result[] = $emp->usertype;
                $result[] = "<button type=\"button\" class=\"btn btn-info btn-sm waves-effect waves-light\" onclick='download(\"employees\",\"".$emp->ID."\")'><i class=\"ti-download\"></i> Download</button>";
                $result[] = view_button(base_url('employees/single_employee/'.$emp->ID))." ".edit_button(base_url('employees/single_employee/'.$emp->ID))." ".delete_button(base_url('employees/delete/'.$emp->ID));
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

    //list of employee for site wise view
    public function site_employee_table($siteID){
        $this->cm->select = "siteemployees.* , siteemployees.ID as seID ,employees.*";
        $this->cm->table_name = "siteemployees";
        $this->cm->join = array('employees'=>'siteemployees.employeeID=employees.ID');
        $this->cm->where = array('siteID'=>$siteID);
        $employees = $this->cm->get();
        if($employees->num_rows() > 0){
            $n=1;
            foreach($employees->result() as $emp){
                $result = array();
                $result[] = $n++;
                $result[] = $emp->name;
                $result[] = $emp->email;
                $result[] = $emp->phone;
                $result[] = file_exists('./uploads/'.$emp->photo) ? "<img src='".base_url('uploads/'.$emp->photo)."' width='30px' />" : "-";
                $result[] = $emp->usertype;
                $result[] = delete_button(base_url('employees/delete_employee_from_site/'.$emp->seID));
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

    public function working_history($employeeID){
        $this->cm->table_name = "siteemployees";
        $this->cm->join = array('sites'=>'siteemployees.siteID=sites.ID');
        $this->cm->where = array('employeeID'=>$employeeID);
        $employees = $this->cm->get();
        if($employees->num_rows() > 0){
            $n=1;
            foreach($employees->result() as $emp){
                $result = array();
                $result[] = $n++;
                $result[] = $emp->name;
                $result[] = $emp->address;
                $result[] = status_button($emp->status);
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

    public function salary_table($employeeID){
        $this->cm->table_name = "employeesalary";
        $this->cm->where = array('employeeID'=>$employeeID);
        $salary = $this->cm->get();
        if($salary->num_rows() > 0){
            $n=1;
            foreach($salary->result() as $sal){
                $result = array();
                $result[] = $n++;
                $result[] = $sal->salary." ৳";
                $result[] = date('F Y',strtotime($sal->date));
                $result[] = payment_status($sal->paid,base_url('salary/give_salary_to_employee/'.$sal->ID.'/'.$sal->paid));
                $result[] = delete_button(base_url('salary/delete_employee_salary/'.$sal->ID));
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
        $this->form_validation->set_rules('email','Email','trim|xss_clean|valid_email|is_unique[employees.email]');
        $this->form_validation->set_rules('phone','Phone','trim|xss_clean|required');
        $this->form_validation->set_rules('join_date','Joining Date','trim|xss_clean|required');
        $this->form_validation->set_rules('salary','Salary','trim|xss_clean|required');
        $this->form_validation->set_rules('address','Address','trim|xss_clean');
        $this->form_validation->set_rules('usertype','User Type','trim|xss_clean|required');

        if($this->form_validation->run() == FALSE){
            $this->send_warning(validation_errors());
        }else{
            $post_data = $this->array_from_post(array('name','email','phone','join_date','salary','address','usertype'));
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
                'photo' => $filenames['photo'],
                'join_date' => $post_data['join_date'],
                'salary' => isset($post_data['salary']) ? $post_data['salary'] : "No File Selected",
                'filename' => $_FILES['document']['name'] ? $_FILES['document']['name'] : "No File Selected",
                'document' => isset($filenames['document']) ? $filenames['document'] : "No File Selected",
                'usertype' => $post_data['usertype'],
            );
            if(isset($insert_data)){
                $this->cm->reset_query();
                $this->cm->table_name = "employees";
                $insert = $this->cm->insert($insert_data);
                if($insert){
                    $this->send_success('Employee Added Successfully');
                }else{
                    $this->send_error('Can\' Add Employee Now, Please Try Again');
                }
            }
        }
    }

    public function add_to_site($siteID = NULL){
        $this->check_site_status($siteID);
        $this->form_validation->set_rules('employeeID','Employee','trim|xss_clean|required|numeric');
        $this->form_validation->set_rules('work_started','Joining Date','trim|xss_clean|required');
        if($this->form_validation->run() == FALSE){
            $this->send_warning(validation_errors());
        }else{
            $post_data = $this->array_from_post(array('employeeID','work_started'));
            $this->cm->table_name = 'siteemployees';
            $this->cm->where = array('employeeID'=>$post_data['employeeID'],'sites.status'=>1);
            $this->cm->join = array('sites'=>'siteemployees.siteID=sites.ID');
            $sites = $this->cm->get();
            if($sites->num_rows() > 0){
                $this->send_error('Employee Was Already Worked On A Active Site');
                exit;
            }
            $insert_data = array(
                'siteID' => $siteID,
                'employeeID' => $post_data['employeeID'],
                'work_started' => $post_data['work_started'],
            );
            $this->cm->table_name = "siteemployees";
            if($this->cm->insert($insert_data)){
                $this->send_success('Employee Added Successfully');
            }else{
                $this->send_error('Can\'t Add Employee Now, Please Try Again');
            }
        }
    }

    public function single_employee($ID = NULL,$return_type = 'json'){
        if($ID != NULL){
            $this->cm->table_name = "employees";
            $this->cm->field_name = "ID";
            $this->cm->primary_key = $ID;
            $employees = $this->cm->get();
            if($employees->num_rows() == (int) 1){
                foreach($employees->result() as $key => $value){
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
                $this->send_error('No Employee Found Regarding This ID');
            }
        }else{
            $this->send_error('No Argument Passed');
        }
    }

    public function edit($ID){
        $emp = $this->single_employee($ID,'array');
        $this->form_validation->set_rules('name','Name','trim|xss_clean|required');
        if($emp->email == $this->input->post('email')){
            $this->form_validation->set_rules('email','Email','trim|xss_clean|required');
        }else{
            $this->form_validation->set_rules('email','Email','trim|xss_clean|valid_email|is_unique[employees.email]');
        }
        $this->form_validation->set_rules('phone','Phone','trim|xss_clean|required');
        $this->form_validation->set_rules('address','Address','trim|xss_clean');
        $this->form_validation->set_rules('join_date','Joining Date','trim|xss_clean|required');
        $this->form_validation->set_rules('salary','Joining Date','trim|xss_clean|required');
        $this->form_validation->set_rules('usertype','User Type','trim|xss_clean|required');
        if($this->form_validation->run() == FALSE){
            $this->send_warning(validation_errors());
        }else{
            $post_data = $this->array_from_post(array('name','email','phone','address','join_date','salary','usertype'));
            if($_FILES){
                foreach($_FILES as $key => $value){
                    $upload = $this->cm->upload($key,'./uploads/');
                    if($upload['status'] == 'success'){
                        $this->cm->delete_file('./uploads/'.$emp->$key);
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
                'photo' => isset($filenames['photo']) ? $filenames['photo'] : $emp->photo,
                'filename' => $_FILES['document']['name'] ? $_FILES['document']['name'] : $emp->filename,
                'document' => isset($filenames['document']) ? $filenames['document'] : $emp->document,
                'usertype' => $post_data['usertype'],
            );
            $this->cm->table_name = "employees";
            $this->cm->field_name = "ID";
            $this->cm->primary_key = $emp->ID;
            if($this->cm->update($update_data)){
                $this->send_success('Employee Updated Successfully');
            }else{
                $this->send_error('Can\' Upudate Employee Now, Please Try Again');
            }
        }
    }

    public function delete($ID = NULL){
        $this->cm->table_name = "siteemployees";
        $this->cm->where = array('employeeID'=>$ID);
        $sites = $this->cm->get();
        if($sites->num_rows() > 0){
            $this->send_error("Employee Was Already Added To ".$sites->num_rows()." Site So You Can't Delete This Employee");
            exit;
        }
        $emp = $this->single_employee($ID,'array');
        if($this->cm->delete_file('./uploads/'.$emp->photo) && $this->cm->delete_file('./uploads/'.$emp->document)){

            $this->cm->_table_name = "employees";
            $this->cm->_field_name = "ID";
            $this->cm->_primary_key = $ID;
            $delete_account = $this->cm->delete();

            $this->cm->reset_query();
            $this->cm->table_name = "employeesalary";
            $this->cm->field_name = "employeeID";
            $this->cm->primary_key = $ID;
            $delete_salary_statement = $this->cm->delete();

            if($delete_account && $delete_salary_statement){
                $this->send_success('Employee Deleted Successfully');
            }else{
                $this->send_error('Can\'t Delete Right Now, Please Try Again');
            }
        }
    }

    public function delete_employee_from_site($ID){
        $this->cm->table_name = "siteemployees";
        $this->cm->where = array('ID'=>$ID);
        $site = $this->cm->get()->row();
        $this->check_site_status($site->siteID);

        if($this->cm->delete()){
            $this->send_success('Employee Deleted From Site Successfully');
        }else{
            $this->send_error('Can\'t  Delete Employee Now, Please Try Again');
        }
    }

}