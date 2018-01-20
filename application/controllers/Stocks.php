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
                $result[] = "<button type=\"button\" class=\"btn btn-info btn-sm waves-effect waves-light\" onclick='download(\"stocks\",\"".$stock->stockID."\")'><i class=\"ti-download\"></i> Download</button>";
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
        $this->check_site_status($siteID);
        $this->form_validation->set_rules('itemID','Item','trim|xss_clean|required|numeric');
        $this->form_validation->set_rules('quantity','Quantity','trim|xss_clean|required|numeric');
        $this->form_validation->set_rules('stocktype','Stock Type','trim|xss_clean|required');
        $this->form_validation->set_rules('date','Date','trim|xss_clean|required');
        if($this->form_validation->run() == FALSE){
            $this->send_warning(validation_errors());
        }else{
            $post_data = $this->array_from_post(array('itemID','quantity','stocktype','date'));
            //check if stocks available for drop or not
            if($post_data['stocktype'] == "Drop"){
                $this->cm->select_sum = "quantity";
                $this->cm->table_name = "stocks";
                $this->cm->where = array('itemID'=>$post_data['itemID'],'stocktype'=>'Add');
                $added = $this->cm->get();

                $this->cm->where = array('itemID'=>$post_data['itemID'],'stocktype'=>"Drop");
                $dropped = $this->cm->get();

                $added = $added->num_rows() > 0 ? $added = $added->row()->quantity : $added = 0 ;
                $dropped = $dropped->num_rows() > 0 ? $dropped = $dropped->row()->quantity : $dropped = 0 ;

                if($post_data['quantity'] > ($added - $dropped)){
                    $this->send_error('Don\'t Have Enough Stock For Drop');
                    exit;
                }
            }
            if($_FILES['document']['name']){
                foreach($_FILES as $key => $value){
                    $upload = $this->cm->upload($key,'./uploads/');
                    if($upload['status'] == 'success'){
                        $filenames[$key] = $upload['file_name'];
                    }else{
                        $filenames[$key] = $upload['error'];
                    }
                }
            }

            $insert_stock = array(
                'siteID' => $siteID,
                'date' => $post_data['date'],
                'stocktype' => $post_data['stocktype'],
                'itemID' => $post_data['itemID'],
                'quantity' => $post_data['quantity'],
                'filename' => $_FILES['document']['name'] ? $_FILES['document']['name'] : "No File Selected",
                'document' => isset($filenames['document']) ? $filenames['document'] : "NO File Selected",
            );

            $this->cm->reset_query();
            $this->cm->table_name = "stocks";
            $tran_ins = $this->cm->insert($insert_stock);

            if($tran_ins){
                $this->send_success('Stock Added Successfully');
            }else{
                $this->send_error('Can\'t Add Stock Now, Please Try Again');
            }
        }
    }

    public function stock($siteID){
        $this->cm->select = 'items.name as item, items.unit as unit';
        $this->cm->select_sum = "quantity";
        $this->cm->table_name = "stocks";
        $this->cm->group_by = "itemID";
        $this->cm->join = array('items'=>'stocks.itemID=items.ID');
        $this->cm->where = array('siteID'=>$siteID,'stocktype'=>'Add');
        $added = $this->cm->get();

        $this->cm->select = 'items.name as item, items.unit as unit';
        $this->cm->select_sum = "quantity";
        $this->cm->table_name = "stocks";
        $this->cm->group_by = "itemID";
        $this->cm->join = array('items'=>'stocks.itemID=items.ID');
        $this->cm->where = array('siteID'=>$siteID,'stocktype'=>'Drop');
        $drops = $this->cm->get();

        $total = array();
        $html = "";
        if($added->num_rows() > 0){
            $html .= "<div class='row mb-2'>";
            foreach($added->result() as $stock){
                $total[$stock->item]['quantity'] = $stock->quantity;
                $total[$stock->item]['unit'] = $stock->unit;
                $html .= "<div class=\"col-xs-12 col-sm-6 col-md-4 uc-item\">";
                $html .= "<a class=\"text-black\">";
                $html .= "<strong>".$stock->quantity." <small>".$stock->unit."</small></strong>";
                $html .= "<span>".$stock->item." ( ADDED )</span>";
                $html .= "</a>";
                $html .= "</div>";
            }
            $html .= "</div>";
        }

        if($drops->num_rows() > 0){
            $html .= "<div class='row mb-2'>";
            foreach($drops->result() as $drop){
                if(array_key_exists($drop->item,$total)){
                    $total[$drop->item]['quantity'] = $total[$drop->item]['quantity'] - $drop->quantity;
                }
                $html .= "<div class=\"col-xs-12 col-sm-6 col-md-4 uc-item\">";
                $html .= "<a class=\"text-black\">";
                $html .= "<strong>".$drop->quantity." <small>".$drop->unit."</small></strong>";
                $html .= "<span>".$drop->item." ( DROPPED )</span>";
                $html .= "</a>";
                $html .= "</div>";
            }
            $html .= "</div>";
        }

        if(count($total) > 0){
            $html .= "<div class='row mb-2'>";
            foreach($total as $key => $value){
                $html .= "<div class=\"col-xs-12 col-sm-6 col-md-4 uc-item\">";
                $html .= "<a class=\"text-black\">";
                $html .= "<strong>".$value['quantity']." <small>".$value['unit']."</small></strong>";
                $html .= "<span>".$key." ( CURRENTLY IN STOCK )</span>";
                $html .= "</a>";
                $html .= "</div>";
            }
            $html .= "</div>";
        }else{
            $html .= "<div><h4>No Stock Report Found</h4></div>";
        }

        $this->send_success($html);
    }

    public function delete($stockID){
        //get Stock
        $this->cm->table_name = "stocks";
        $this->cm->where = array('ID'=>$stockID);
        $stock = $this->cm->get()->row();
        $this->check_site_status($stock->siteID);
        if($this->cm->delete_file('./uploads/'.$stock->document)){
            $this->cm->delete() ? $this->send_success('Stock Deleted Successfully') : $this->send_error('Can\'t Delete Stock Now, Please Try Again');
        }else{
            $this->send_error('Can\'t Delete Stock Now, Please Try Again');
        }
    }

}