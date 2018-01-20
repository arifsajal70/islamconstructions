<?php defined('BASEPATH') or exit('No DIrect script access allowed');

class Cron extends MY_Controller{

    public function index(){
        $this->cm->table_name = "engineersalary";
        $this->cm->where = array('date'=>date('Y-m'));
        $engsals = $this->cm->get();

        $this->cm->reset_query();
        $this->cm->table_name = "engineers";
        $engs = $this->cm->get();

        if($engsals->num_rows() < $engs->num_rows()){
            if($engs->num_rows() > 0){
                foreach($engs->result() as $eng){
                    $this->cm->reset_query();
                    $this->cm->table_name = "engineersalary";
                    $this->cm->where = array('date'=>date('Y-m'),'engineerID'=>$eng->ID);
                    $salary = $this->cm->get();
                    if($salary->num_rows() == 0){
                        $array = array(
                            'engineerID' => $eng->ID,
                            'salary' => $eng->salary,
                            'date' => date('Y-m'),
                        );
                        $this->cm->table_name = "engineersalary";
                        $this->cm->insert($array);
                    }
                }
            }
        }

        $this->cm->reset_query();
        $this->cm->table_name = "managersalary";
        $this->cm->where = array('date'=>date('Y-m'));
        $mansals = $this->cm->get();

        $this->cm->reset_query();
        $this->cm->table_name = "managers";
        $mans = $this->cm->get();

        if($mansals->num_rows() < $mans->num_rows()){
            if($mans->num_rows() > 0){
                foreach($mans->result() as $man){
                    $this->cm->reset_query();
                    $this->cm->table_name = "managersalary";
                    $this->cm->where = array('date'=>date('Y-m'),' managerID'=>$man->ID);
                    $salary = $this->cm->get();
                    if($salary->num_rows() == 0){
                        $array = array(
                            'managerID' => $man->ID,
                            'salary' => $man->salary,
                            'date' => date('Y-m'),
                        );
                        $this->cm->table_name = "managersalary";
                        $this->cm->insert($array);
                    }
                }
            }
        }

        $this->cm->reset_query();
        $this->cm->table_name = "employeesalary";
        $this->cm->where = array('date'=>date('Y-m'));
        $emsal = $this->cm->get();

        $this->cm->reset_query();
        $this->cm->table_name = "employees";
        $emps = $this->cm->get();

        if($emsal->num_rows() < $emps->num_rows()){
            if($emps->num_rows() > 0){
                foreach($emps->result() as $emp){
                    $this->cm->reset_query();
                    $this->cm->table_name = "employeesalary";
                    $this->cm->where = array('date'=>date('Y-m'),'employeeID'=>$emp->ID);
                    $salary = $this->cm->get();
                    if($salary->num_rows() == 0){
                        $array = array(
                            'employeeID' => $emp->ID,
                            'salary' => $emp->salary,
                            'date' => date('Y-m'),
                        );
                        $this->cm->table_name = "employeesalary";
                        $this->cm->insert($array);
                    }
                }
            }
        }

    }

}