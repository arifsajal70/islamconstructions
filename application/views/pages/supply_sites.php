<?php defined('BASEPATH') or exit('No DIrect script access allowed');?>
<?php
$this->cm->table_name = "items";
$items = $this->cm->get();
$this->cm->table_name = 'managers';
$this->cm->where = array('usertype'=>"Site Manager");
$managers = $this->cm->get();
?>
<div class="box box-block bg-white table-responsive" id="site-table-view">
    <table class="table table-striped table-bordered dataTable" id="sitesTable" style="width:100%;">
        <thead>
        <tr>
            <th>SL</th>
            <th>Name</th>
            <th>Address</th>
            <th>Site Type</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>SL</th>
            <th>Name</th>
            <th>Address</th>
            <th>Site Type</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </tfoot>
    </table>
</div>

<!-- Construction Site View  -->
<div class="box box-block bg-white" id="supply-site-view" style="display:none;">
    <div class="profile-header mb-1">
        <div class="profile-header-cover img-cover" style="background-image: url(<?php echo base_url('assets/');?>img/photos-1/1.jpg);"></div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4 col-md-3">
                <div class="card profile-card">
                    <div class="profile-avatar">
                        <img class="site-image" width="100%" onerror="this.src='<?php echo base_url('uploads/system/default-construction.jpg');?>'">
                    </div>
                    <div class="card-block">
                        <h4 class="mb-0-25 site-name">[Default Name]</h4>
                        <div class="text-muted mb-1 site-address">[Default Address]</div>
                    </div>
                </div>
            </div>
            <div class="col-sm-8 col-md-9  mt-2">
                <div class="card mb-0">
                    <ul class="nav nav-tabs nav-tabs-2 profile-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#supply-site-bills" role="tab">Bills</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#supply-site-payments" role="tab">Payments</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#supply-site-managers" role="tab">Managers</a>
                        </li>
                    </ul>
                    <div class="tab-content">

                        <div class="tab-pane active card-block" id="supply-site-bills" role="tabpanel">
                            <div class="col-xs-12">
                                <button type="button" class="btn btn-primary col-xs-12 pull-right mb-1 " data-toggle="modal" data-target="#addBill">Add Bill</button>
                            </div>
                            <div class="col-md-12 table-responsive">
                                <table class="table table-striped table-bordered" id="siteBillsTable" style="width:100%;">
                                    <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Title</th>
                                        <th>Date</th>
                                        <th>Item</th>
                                        <th>Quantity</th>
                                        <th>Rate</th>
                                        <th>Total</th>
                                        <th>Download</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>SL</th>
                                        <th>Title</th>
                                        <th>Date</th>
                                        <th>Item</th>
                                        <th>Quantity</th>
                                        <th>Rate</th>
                                        <th>Total</th>
                                        <th>Download</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                        <div class="tab-pane card-block" id="supply-site-payments" role="tabpanel">
                            <div class="col-md-12 user-1 mb-1">
                                <div class="u-counters">
                                    <div class="row no-gutter" id="payments-report">
                                        [Demo Accounts Report]
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <button type="button" class="btn btn-primary col-xs-12 pull-right mb-1 " data-toggle="modal" data-target="#addPayment">Add Payment</button>
                            </div>
                            <div class="col-md-12 table-responsive">
                                <table class="table table-striped table-bordered" id="sitePaymentsTable" style="width:100%;">
                                    <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Title</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Download</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>SL</th>
                                        <th>Title</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Download</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                        <div class="tab-pane card-block" id="supply-site-managers" role="tabpanel">
                            <div class="col-xs-12">
                                <button type="button" class="btn btn-primary col-xs-12 pull-right mb-1 " data-toggle="modal" data-target="#addManager">Add Manager</button>
                            </div>
                            <div class="col-md-12 table-responsive">
                                <table class="table table-striped table-bordered" id="siteManagersTable" style="width:100%;">
                                    <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Manager Name</th>
                                        <th>Manager Email</th>
                                        <th>Manager Phone</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>SL</th>
                                        <th>Manager Name</th>
                                        <th>Manager Email</th>
                                        <th>Manager Phone</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
<!-- Construction Site View End -->

<button class="btn btn-success btn-circle btn-lg btn-float-right" data-toggle="modal" data-target="#addingModal"><i class="ti-plus"></i></button>
<button class="btn btn-danger btn-circle btn-lg btn-float-right" id="back" style="display:none;"><i class="ti-arrow-left"></i></button>

<!--Adding Modal -->
<div class="modal fade" role="dialog" aria-labelledby="addingModal" aria-hidden="true" id="addingModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Add Site</h4>
            </div>
            <form id="addForm" action="<?php echo base_url('sites/add')?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="sitetype" value="Supply">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" placeholder="Name" name="name">
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <textarea type="text" class="form-control" row="5" placeholder="Address" name="address"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Created</label>
                        <input type="text" class="form-control datepicker" placeholder="yyyy-mm-dd" name="created">
                    </div>
                    <div class="form-group">
                        <label>Photo</label>
                        <input type="file" class="dropify" name="photo">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Site</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--Adding Modal Ends -->

<button data-toggle="modal" data-target="#editingModal" style="display:none;"></button>
<!-- Editing Modal -->
<div class="modal fade" role="dialog" aria-labelledby="editingModaleditingModal" aria-hidden="true" id="editingModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Edit Engineer</h4>
            </div>
            <form id="editForm" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" placeholder="Name" name="name">
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <textarea type="text" class="form-control" row="5" placeholder="Address" name="address"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Created</label>
                        <input type="text" class="form-control datepicker" placeholder="yyyy-mm-dd" name="created">
                    </div>
                    <div class="form-group">
                        <label>Photo</label>
                        <input type="file" class="dropify" name="photo">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Site</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--Editing Modal Ends -->

<!-- Bill Add -->
<div class="modal fade" role="dialog" aria-labelledby="addBill" aria-hidden="true" id="addBill">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Add Bill</h4>
            </div>
            <form method="post" enctype="multipart/form-data" id="billForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" placeholder="Title" name="title">
                    </div>
                    <div class="form-group">
                        <label>Date</label>
                        <input type="text" class="form-control datepicker" name="date" value="<?php echo date('Y-m-d');?>">
                    </div>
                    <div class="form-group">
                        <label>Item</label>
                        <select name="itemID" class="form-control select2" style="width:100%;" aria-hidden="true">
                            <option value="">Select Item</option>
                            <?php if($items->num_rows() > 0):foreach($items->result() as $item):?>
                                <option value="<?php echo $item->ID;?>"><?php echo $item->name;?></option>
                            <?php endforeach;endif;?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Quantity</label>
                        <input type="number" class="form-control" placeholder="Quantity" name="quantity">
                    </div>
                    <div class="form-group">
                        <label>Rate Per Item</label>
                        <input type="number" class="form-control" placeholder="Rate Per Item" name="rate">
                    </div>
                    <div class="form-group">
                        <label>Documents</label>
                        <input type="file" class="dropify" name="document">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Bill</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Bill Add Ends -->


<!-- Payment Add -->
<div class="modal fade" role="dialog" aria-labelledby="addPayment" aria-hidden="true" id="addPayment">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Add Payment</h4>
            </div>
            <form method="post" enctype="multipart/form-data" id="paymentForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" placeholder="Title" name="title">
                    </div>
                    <div class="form-group">
                        <label>Date</label>
                        <input type="text" class="form-control datepicker" name="date" value="<?php echo date('Y-m-d');?>">
                    </div>
                    <div class="form-group">
                        <label>Amount</label>
                        <input type="number" class="form-control" placeholder="Amount" name="amount">
                    </div>
                    <div class="form-group">
                        <label>Documents</label>
                        <input type="file" class="dropify" name="document">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Payment</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Payment Add Ends -->

<!-- Manager Add -->
<div class="modal fade" role="dialog" aria-labelledby="addManager" aria-hidden="true" id="addManager">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Add Manager</h4>
            </div>
            <form id="addManagerForm" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Select Manager</label>
                        <select name="managerID" class="form-control select2" style="width:100%;">
                            <option value="">Select Manager</option>
                            <?php if($managers->num_rows() > 0):foreach($managers->result() as $man):?>
                            <option value="<?php echo $man->ID ;?>"><?php echo $man->name ;?></option>
                            <?php endforeach;endif;?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Manager</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Manager Add Ends -->