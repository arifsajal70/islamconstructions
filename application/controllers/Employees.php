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
        $this->cm->table_name = "employees";
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
        $this->form_validation->set_rules('address','Address','trim|xss_clean');
        $this->form_validation->set_rules('siteID','Site','trim|xss_clean|required');
        $this->form_validation->set_rules('usertype','User Type','trim|xss_clean|required');

        if($this->form_validation->run() == FALSE){
            $this->send_warning(validation_errors());
        }else{
            $post_data = $this->array_from_post(array('name','email','phone','address','siteID','usertype'));
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
                'siteID' => $post_data['siteID'],
                'photo' => $filenames['photo'],
                'document' => $filenames['document'],
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
            $filenames['photo'] = $emp->photo;
            $filenames['document'] = $emp->document;
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
        $emp = $this->single_employee($ID,'array');
        if($this->cm->delete_file('./uploads/'.$emp->photo) && $this->cm->delete_file('./uploads/'.$emp->document)){
            $this->cm->_table_name = "employees";
            $this->cm->_field_name = "ID";
            $this->cm->_primary_key = $ID;
            if($this->cm->delete()){
                $this->send_success('Employee Deleted Successfully');
            }else{
                $this->send_error('Can\'t Delete Right Now, Please Try Again');
            }
        }
    }

}