<?php defined('BASEPATH') or exit('No Direct Script access allowed');

/**
 * @property CI_Email $email
 */
class Crud_Model extends MY_Model{

    public $table_name;
    public $select;
    public $select_sum;
    public $field_name;
    public $primary_key;
    public $where;
    public $join;
    public $group_by;

    public function reset_query(){
        $this->table_name = NULL;
        $this->select = NULL;
        $this->select_sum = NULL;
        $this->field_name = NULL;
        $this->primary_key = NULL;
        $this->where = NULL;
        $this->join = NULL;
        $this->group_by = NULL;
    }

}
