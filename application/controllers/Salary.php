<?php defined('BASEPATH') or exit('No DIrect script access allowed');

class Salary extends MY_Controller{

    public function give_salary_to_engineer($ID,$status){
        switch ($status){
            case (int) 0;
                $status = (int) 1;
                break;
            case (int) 1;
                $status = (int) 0;
                break;
        }
        $status  = array('paid'=>$status);
        $this->cm->table_name = "engineersalary";
        $this->cm->field_name = "ID";
        $this->cm->primary_key = $ID;
        if($this->cm->update($status)){
            $this->send_success('Payment Status Updated Successfully');
        }else{
            $this->send_error('Can\' Update Payment Status Now, Please Try Again');
        }
    }

    public function generate_engineer_salary($ID){
        $this->cm->table_name = "engineersalary";
        $this->cm->where = array('engineerID'=>$ID,'date'=>date('Y-m'));
        $salary = $this->cm->get();
        if($salary->num_rows() > 0){
            $this->send_success('Salary Already generated,');
            exit;
        }
        $this->cm->table_name = "engineers";
        $this->cm->where = array('ID'=>$ID);
        $engineer = $this->cm->get();
        if($engineer->num_rows() > 0){
            $array = array(
                'engineerID' => $ID,
                'salary' => $engineer->row()->salary,
                'paid' => 0,
                'date' => date('Y-m'),
            );
            $this->cm->reset_query();
            $this->cm->table_name = "engineersalary";
            if($this->cm->insert($array)){
                $this->send_success('Salary Generated Successfully');
            }else{
                $this->send_error('Can\'t generate Salary Now, Please Try Again.');
            }
        }else{
            $this->send_error('No Engineer Found');
        }
    }

    public function delete_engineer_salary($ID){
    	$this->input->is_ajax_request() || exit("You can't access this page Directly");
    	$this->session->usertype == "Admin" || show_404();

        $this->cm->table_name = "engineersalary";
        $this->cm->where = array('ID'=>$ID);
        if($this->cm->delete()){
            $this->send_success('Salary Statement Deleted Successfully');
        }else{
            $this->send_error('Can\'t Delete Salary Statement, Please Try Again');
        }
    }

    public function give_salary_to_manager($ID,$status){
        switch ($status){
            case (int) 0;
                $status = (int) 1;
                break;
            case (int) 1;
                $status = (int) 0;
                break;
        }
        $status  = array('paid'=>$status);
        $this->cm->table_name = "managersalary";
        $this->cm->field_name = "ID";
        $this->cm->primary_key = $ID;
        if($this->cm->update($status)){
            $this->send_success('Payment Status Updated Successfully');
        }else{
            $this->send_error('Can\' Update Payment Status Now, Please Try Again');
        }
    }

    public function generate_manager_salary($ID){
        $this->cm->table_name = "managersalary";
        $this->cm->where = array('managerID'=>$ID,'date'=>date('Y-m'));
        $salary = $this->cm->get();
        if($salary->num_rows() > 0){
            $this->send_success('Salary Already generated,');
            exit;
        }
        $this->cm->table_name = "managers";
        $this->cm->where = array('ID'=>$ID);
        $manager = $this->cm->get();
        if($manager->num_rows() > 0){
            $array = array(
                'managerID' => $ID,
                'salary' => $manager->row()->salary,
                'paid' => 0,
                'date' => date('Y-m'),
            );
            $this->cm->reset_query();
            $this->cm->table_name = "managersalary";
            if($this->cm->insert($array)){
                $this->send_success('Salary Generated Successfully');
            }else{
                $this->send_error('Can\'t generate Salary Now, Please Try Again.');
            }
        }else{
            $this->send_error('No Engineer Found');
        }
    }

    public function delete_manager_salary($ID){
        $this->cm->table_name = "managersalary";
        $this->cm->where = array('ID'=>$ID);
        if($this->cm->delete()){
            $this->send_success('Salary Statement Deleted Successfully');
        }else{
            $this->send_error('Can\'t Delete Salary Statement, Please Try Again');
        }
    }

    public function give_salary_to_employee($ID,$status){
        switch ($status){
            case (int) 0;
                $status = (int) 1;
                break;
            case (int) 1;
                $status = (int) 0;
                break;
        }
        $status  = array('paid'=>$status);
        $this->cm->table_name = "employeesalary";
        $this->cm->field_name = "ID";
        $this->cm->primary_key = $ID;
        if($this->cm->update($status)){
            $this->send_success('Payment Status Updated Successfully');
        }else{
            $this->send_error('Can\' Update Payment Status Now, Please Try Again');
        }
    }

    public function generate_employee_salary($ID){
        $this->cm->table_name = "employeesalary";
        $this->cm->where = array('employeeID'=>$ID,'date'=>date('Y-m'));
        $salary = $this->cm->get();
        if($salary->num_rows() > 0){
            $this->send_success('Salary Already generated,');
            exit;
        }
        $this->cm->table_name = "employees";
        $this->cm->where = array('ID'=>$ID);
        $employee = $this->cm->get();
        if($employee->num_rows() > 0){
            $array = array(
                'employeeID' => $ID,
                'salary' => $employee->row()->salary,
                'paid' => 0,
                'date' => date('Y-m'),
            );
            $this->cm->reset_query();
            $this->cm->table_name = "employeesalary";
            if($this->cm->insert($array)){
                $this->send_success('Salary Generated Successfully');
            }else{
                $this->send_error('Can\'t generate Salary Now, Please Try Again.');
            }
        }else{
            $this->send_error('No Engineer Found');
        }
    }

    public function delete_employee_salary($ID){
        $this->cm->table_name = "employeesalary";
        $this->cm->where = array('ID'=>$ID);
        if($this->cm->delete()){
            $this->send_success('Salary Statement Deleted Successfully');
        }else{
            $this->send_error('Can\'t Delete Salary Statement, Please Try Again');
        }
    }

}
