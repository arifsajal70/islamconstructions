<?php defined('BASEPATH') or exit('No DIrect script access allowed');

class MY_Model extends CI_Model{

    protected $table_name;
    protected $select;
    protected $primary_key;
    protected $field_name;
    protected $where;
    protected $join;
    protected $group_by;
    protected $order_by;

    function __construct(){
        parent::__construct();
        $this->load->database();
    }

    private function _select(){
        if($this->select){
            $this->db->select($this->select);
        }else{
            $this->db->select('*');
        }
    }

    private function _from(){
        if($this->table_name){
            $this->db->from($this->table_name);
        }else{
            log_message('error','No Table Selected');
        }
    }

    private function _where(){
        if($this->field_name && $this->primary_key){
            $this->db->where($this->field_name,$this->primary_key);
        }elseif(is_array($this->where)){
            foreach($this->where as $key => $value){
                $where[$key] = $value;
            }
            $this->db->where($where);
        }else{
            log_message('error','Invalid Where Arguement Passed');
        }
    }

    private function _join(){
        if(is_array($this->join)){
            foreach($this->join as $key => $value){
                $this->db->join($key,$value);
            }
        }else{
            log_message('error','Invalid Join Query');
        }
    }

    private function _group_by(){
        if($this->group_by){
            $this->db->group_by($this->group_by);
        }
    }

    private function _order_by(){
        if(is_array($this->order_by)){
            $this->db->order_by($this->order_by[0],$this->order_by[1]);
        }else{
            $this->db->order_by($this->table_name.'.ID','DESC');
        }
    }

    public function get(){
        $this->_select();
        $this->_from();
        $this->_join();
        $this->_group_by();
        $this->_where();
        $this->_order_by();
        return $this->db->get();
    }

    public function delete(){
        if($this->field_name && $this->primary_key){
            if($this->db->delete($this->table_name,array($this->field_name=>$this->primary_key))){
                return TRUE;
            }else{
                return FALSE;
            }
        }
    }

    public function insert($data = array()){
        if($this->table_name && is_array($data)){
            $this->db->insert($this->table_name,$data);
            return $this->db->insert_id();
        }else{
            log_message('error','No Table Selected Or Invalid Data Passed');
        }
    }

    public function update($data = array()){
        if($this->table_name && ($this->field_name || $this->where)){
            $this->db->set($data,FALSE);
            $this->_where();
            if($this->db->update($this->table_name)){
                return TRUE;
            }else{
                return FALSE;
            }
        }
    }

    public function  upload($field,$path){
        $this->load->helper('string');
        $config['upload_path'] = $path;
        $config['allowed_types'] = 'gif|jpg|jpeg|png|zip|rar';
        $config['max_size'] = 1024000;
        $config['file_name'] = time().random_string('alnum',20).time();
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ($this->upload->do_upload($field)) {
            $file_data = $this->upload->data();
            $file_name = $config['file_name'].$file_data['file_ext'] ;
            $success = array('status'=>'success','file_name'=>$file_name);
            return $success;
        }
        else {
            $error = array('status'=>'error','error'=>$this->upload->display_errors());
            return $error;
        }
    }

    public function delete_file($file){
        $this->load->helper('file');
        if(file_exists($file)){
            return unlink($file);
        }else{
            return TRUE;
        }
    }

    public function send_mail($from,$to,$subject,$message){
        $this->load->library('email');
        $this->email->from($from);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->set_mailtype('html');
        return $this->email->send();
    }

}