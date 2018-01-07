<?php defined('BASEPATH') or exit('No DIrect script access allowed');

class Items extends MY_Controller{

    public function index(){
        $data['loader'] = $this->load(array(
                'datatables',
                'upload',
                'alert',
                'datepicker',
                'customjs'=> array(
                    base_url('assets/ajax/main.js'),
                    base_url('assets/ajax/item.js'))
            )
        );
        $data['page_title'] = "Items";
        $data['subview'] = "items";
        $this->load->view('mainView',$data);
    }

    public function item_table(){
        $this->cm->table_name = "items";
        $items = $this->cm->get();
        if($items->num_rows() > 0){
            $n=1;
            foreach($items->result() as $item){
                $result = array();
                $result[] = $n++;
                $result[] = $item->name;
                $result[] = $item->unit;
                $result[] = $item->price;
                $result[] = edit_button(base_url('items/single_item/'.$item->ID))." ".delete_button(base_url('items/delete/'.$item->ID));
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
        $this->form_validation->set_rules('name','Item Name','trim|xss_clean|required');
        $this->form_validation->set_rules('unit','Item Unit','trim|xss_clean|required');
        $this->form_validation->set_rules('price','Item Ptice Per Unit','trim|xss_clean|required');
        if($this->form_validation->run() == FALSE){
            $this->send_warning(validation_errors());
        }else{
            $post_data = $this->array_from_post(array('name','unit','price'));
            $insert_data = array(
                'name' => $post_data['name'],
                'unit' => $post_data['unit'],
                'price' => $post_data['price'],
            );
            $this->cm->table_name = "items";
            if($this->cm->insert($insert_data)){
                $this->send_success('Item Added Successfully');
            }else{
                $this->send_error('Can\' Add Item Now, Please Try Again');
            }
        }
    }

    public function single_item($ID = NULL,$return_type = 'json'){
        if($ID != NULL){
            $this->cm->table_name = "items";
            $this->cm->field_name = "ID";
            $this->cm->primary_key = $ID;
            $items = $this->cm->get();
            if($items->num_rows() == (int) 1){
                foreach($items->result() as $key => $value){
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

    public function edit($ID = NULL){
        $this->form_validation->set_rules('name','Item Name','trim|xss_clean|required');
        $this->form_validation->set_rules('unit','Item Unit','trim|xss_clean|required');
        $this->form_validation->set_rules('price','Item Ptice Per Unit','trim|xss_clean|required');
        if($this->form_validation->run() == FALSE){
            $this->send_warning(validation_errors());
        }else{
            $post_data = $this->array_from_post(array('name','unit','price'));
            $update_data = array(
                'name' => $post_data['name'],
                'unit' => $post_data['unit'],
                'price' => $post_data['price'],
            );
            $this->cm->table_name = "items";
            $this->cm->field_name = "ID";
            $this->cm->primary_key = $ID;
            if($this->cm->update($update_data)){
                $this->send_success('Item Updated Successfully');
            }else{
                $this->send_error('Can\' Update Item Now, Please Try Again');
            }
        }
    }

}