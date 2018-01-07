<?php defined('BASEPATH') or exit('No DIrect script access allowed');

class Stocks extends MY_Controller{

    public function stocks_table($siteID){
        $this->cm->select = "stocks.* , items.* , stocks.ID as stockID";
        $this->cm->table_name = 'stocks';
        $this->cm->field_name = 'siteID';
        $this->cm->primary_key = $siteID;
        $this->cm->join = array('items'=>'stocks.itemID=items.ID');
        $stocks = $this->cm->get();
        if($stocks->num_rows() > 0){
            $n=1;
            foreach($stocks->result() as $stock){
                $result = array();
                $result[] = $n++;
                $result[] = $stock->name;
                $result[] = $stock->quantity." ".$stock->unit;
                $result[] = $stock->date;
                $result[] = $stock->stocktype;
                $result[] = delete_button(base_url('stocks/delete/'.$stock->stockID));
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

    public function add($siteID = NULL){
        $this->form_validation->set_rules('itemID','Item','trim|xss_clean|required|numeric');
        $this->form_validation->set_rules('quantity','Quantity','trim|xss_clean|required|numeric');
        $this->form_validation->set_rules('stocktype','Stock Type','trim|xss_clean|required');
        $this->form_validation->set_rules('date','Date','trim|xss_clean|required');
        if($this->form_validation->run() == FALSE){
            $this->send_warning(validation_errors());
        }else{
            $post_data = $this->array_from_post(array('itemID','quantity','stocktype','date'));
            $this->cm->table_name = "stocktotal";
            $this->cm->where = array('siteID'=>$siteID,'itemID'=>$post_data['itemID']);
            $stock = $this->cm->get();
            if($stock->num_rows() > 0){
                $quantity = 0;
                if($post_data['stocktype'] == "Add"){
                    $quantity = $stock->row()->quantity + $post_data['quantity'];
                }elseif($post_data['stocktype'] == "Drop"){
                    if($stock->row()->quantity  >= $post_data['quantity']){
                        $quantity = $stock->row()->quantity - $post_data['quantity'];
                    }else{
                        $this->send_error('Enough Stock Is Not Available For Drop');
                        exit;
                    }
                }
                $insert = array(
                    'siteID' => $siteID,
                    'itemID' => $post_data['itemID'],
                    'stocktype' => $post_data['stocktype'],
                    'quantity' => $post_data['quantity'],
                    'date' => $post_data['date'],
                );
                $update = array(
                    'quantity' => $quantity,
                );
                $this->cm->table_name = "stocktotal";
                $this->cm->field_name = "ID";
                $this->cm->primary_key = $stock->row()->ID;
                if($this->cm->update($update)){
                    $this->cm->reset_query();
                    $this->cm->table_name = "stocks";
                    if($this->cm->insert($insert)){
                        $this->send_success('Stock Added Successfully');
                    }
                }else{
                    $this->send_error('Can\' Add Stock Now, Please Try Again');
                }
            }else{
                //add stock if not available in stock totals
                $insert = array(
                    'siteID' => $siteID,
                    'itemID' => $post_data['itemID'],
                    'quantity' => (int) 0,
                );
                $this->cm->insert($insert);
                $this->add($siteID);
            }
        }
    }

    public function stock($siteID){
        $this->cm->table_name = 'stocktotal';
        $this->cm->where = array('siteID'=>$siteID);
        $this->cm->join = array('items'=>'stocktotal.itemID=items.ID');
        $stock = $this->cm->get();
        if($stock->num_rows() > 0){
            $html = "";
            foreach($stock->result() as $stock){
                $html .= "<div class=\"col-xs-12 col-sm-6 col-md-4 uc-item\">";
                $html .= "<a class=\"text-black\">";
                $html .= "<strong>".$stock->quantity." <small>".$stock->unit."</small></strong>";
                $html .= "<span>".$stock->name."</span>";
                $html .= "</a>";
                $html .= "</div>";
            }
            $this->send_success($html);
        }else{
            $this->send_error('No Stock Available');
        }
    }

    public function delete($stockID){
        //get Stock
        $this->cm->table_name = "stocks";
        $this->cm->field_name = "ID";
        $this->cm->primary_key = $stockID;
        $stock = $this->cm->get();
        if($stock->num_rows() > 0){
            $this->cm->reset_query();
            $this->cm->table_name = "stocktotal";
            $this->cm->where = array('siteID'=>$stock->row()->siteID,'itemID'=>$stock->row()->itemID);
            $stocktotal = $this->cm->get()->row();
            $quantity = 0;
            if($stock->row()->stocktype == "Add"){
                $quantity = $stocktotal->quantity - $stock->row()->quantity;
            }elseif($stock->row()->stocktype == "Drop"){
                $quantity = $stocktotal->quantity + $stock->row()->quantity;
            }
            $update = array(
                'quantity' => $quantity,
            );
            $this->cm->reset_query();
            $this->cm->table_name = "stocktotal";
            $this->cm->field_name = "ID";
            $this->cm->primary_key = $stocktotal->ID;
            if($this->cm->update($update)){
                $this->cm->reset_query();
                $this->cm->table_name = "stocks";
                $this->cm->field_name = "ID";
                $this->cm->primary_key = $stockID;
                if($this->cm->delete()){
                    $this->send_success('Stock Deleted Successfully');
                }else{
                    $this->send_error('can\' Delete Stock');
                }
            }else{
                $this->send_error('can\' Delete Stock Now, Please Try Again');
            }
        }
    }

}