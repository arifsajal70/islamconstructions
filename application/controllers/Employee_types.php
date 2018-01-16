<?php defined('BASEPATH') or exit('No DIrect script access allowed');

class Employee_types extends MY_Controller{

    public function index(){
        $data['loader'] = $this->load(array(
                'datatables',
                'upload',
                'alert',
                'customjs'=> array(
                    base_url('assets/ajax/main.js'),
                    base_url('assets/ajax/employee_types.js')
                )
            )
        );
        $data['page_title'] = "Employee Types";
        $data['subview'] = "employee_types";
        $this->load->view('mainView',$data);
    }

    public function employee_type_table(){
        $this->cm->table_name = "usertypes";
        $types = $this->cm->get();
        if($types->num_rows() > 0){
            $n=1;
            foreach($types->result() as $type){
                $result = array();
                $result[] = $n++;
                $result[] = $type->usertype;
                $result[] = $type->note;
                $result[] = edit_button('employee_types/single_employee_type/'.$type->ID)." ".delete_button(base_url('employee_types/delete/'.$type->ID));
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
        $this->form_validation->set_rules('type','Employee Type','trim|xss_clean|required');
        $this->form_validation->set_rules('note','Note','trim|xss_clean|required');
        if($this->form_validation->run() == FALSE){
            $this->send_warning(validation_errors());
        }else{
            $post_data = $this->array_from_post(array('type','note'));
            $insert_data = array(
                'usertype' => $post_data['type'],
                'note' => $post_data['note'],
            );
            $this->cm->table_name = "usertypes";
            if($this->cm->insert($insert_data)){
                $this->send_success('Employee Type Added Successfully');
            }else{
                $this->send_error('Can\'t Add Employee Type, Please Try Again');
            }
        }
    }

    public function single_employee_type($ID = NULL,$return_type = 'json'){
        if($ID != NULL){
            $this->cm->table_name = "usertypes";
            $this->cm->field_name = "ID";
            $this->cm->primary_key = $ID;
            $types = $this->cm->get();
            if($types->num_rows() == (int) 1){
                foreach($types->result() as $key => $value){
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
                $this->send_error('No Employee Type Found Regarding This ID');
            }
        }else{
            $this->send_error('No Arguement Passed');
        }
    }

    public function edit($ID){
        $this->form_validation->set_rules('type','Employee Type','trim|xss_clean|required');
        $this->form_validation->set_rules('note','Note','trim|xss_clean|required');
        if($this->form_validation->run() == FALSE){
            $this->send_warning(validation_errors());
        }else{
            $post_data = $this->array_from_post(array('type','note'));
            $update_data = array(
                'usertype' => $post_data['type'],
                'note' => $post_data['note'],
            );
            $this->cm->table_name = "usertypes";
            $this->cm->where = array('ID'=>$ID);
            if($this->cm->update($update_data)){
                $this->send_success('Employee Type Updated Successfully');
            }else{
                $this->send_error('Can\'t Update Employee Type, Please Try Again');
            }
        }
    }

}