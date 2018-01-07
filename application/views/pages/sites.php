<?php defined('BASEPATH') or exit('No DIrect script access allowed');?>
<?php
    $this->cm->table_name = "engineers";
    $engineer = $this->cm->get();
    $this->cm->reset_query();
    $this->cm->table_name = "items";
    $items = $this->cm->get();
?>
<div class="box box-block bg-white table-responsive" id="site-table-view">
    <table class="table table-striped table-bordered dataTable" id="sitesTable" style="width:100%;">
        <thead>
        <tr>
            <th>SL</th>
            <th>Name</th>
            <th>Address</th>
            <th>Site Type</th>
            <th>Action</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>SL</th>
            <th>Name</th>
            <th>Address</th>
            <th>Site Type</th>
            <th>Action</th>
        </tr>
        </tfoot>
    </table>
</div>

<!-- Construction Site View  -->
<div class="box box-block bg-white" id="construction-site-view" style="display:none;">
    <div class="profile-header mb-1">
        <div class="profile-header-cover img-cover" style="background-image: url(<?php echo base_url('assets/');?>img/photos-1/1.jpg);"></div>
        <div class="profile-header-counters clearfix">
            <div class="container-fluid">
                <div class="float-xs-right">
                    <a href="#" class="text-black">
                        <h5 class="font-weight-bold">2k</h5>
                        <span class="text-muted">Construction</span>
                    </a>
                </div>
                <div class="float-xs-right">
                    <a href="#" class="text-black">
                        <h5 class="font-weight-bold">320</h5>
                        <span class="text-muted">Following</span>
                    </a>

                </div>
                <div class="float-xs-right">
                    <a href="#" class="text-black">
                        <h5 class="font-weight-bold">190</h5>
                        <span class="text-muted">Activities</span>
                    </a>
                </div>
            </div>
        </div>
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
            <div class="col-sm-8 col-md-9">
                <div class="card mb-0">
                    <ul class="nav nav-tabs nav-tabs-2 profile-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#engineer-profile" role="tab">Engineer</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#construction-site-stock" role="tab">Stock</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#construction-site-accounts" role="tab">Accounts</a>
                        </li>
                    </ul>


                    <div class="tab-content">

                        <!-- Construction Site Enginner Profile -->
                        <div class="tab-pane active table-responsive" id="engineer-profile" role="tabpanel">
                            <div class="col-md-12 mt-2">
                                <div class="box bg-white user-4 img-cover" style="background-image: url(<?php echo base_url('assets/')?>img/photos-1/1.jpg);">
                                    <div class="u-content">
                                        <h5><a class="text-white" id="engineer-name">[Default Name]</a></h5>
                                        <p class="mb-2" id="engineer-email">[Default Email]</p>
                                        <div class="avatar box-64 mb-2">
                                            <img class="b-a-radius-circle shadow-success" src="uploads" onerror="this.src='<?php echo base_url('uploads/system/default-user.jpg');?>'">
                                        </div>
                                        <div class="text-xs-center mt-0-5">
                                            <a class="btn btn-primary btn-rounded mx-0-5" id="callNow">Call Now</a>
                                            <a class="btn btn-outline-primary btn-rounded mx-0-5" id="textNow">Message</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Construction Site Enginner Profile end -->

                        <!-- Construction Site stock -->
                        <div class="tab-pane card-block" id="construction-site-stock" role="tabpanel">
                            <div class="col-md-12 user-1 mb-1">
                                <div class="u-counters">
                                    <div class="row no-gutter" id="stock-report">
                                        [Demo Stock Report]
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <button type="button" class="btn btn-primary col-xs-12 pull-right mb-1 " data-toggle="modal" data-target="#recordStock">Record Stock</button>
                            </div>
                            <div class="col-md-12 table-responsive">
                                <table class="table table-striped table-bordered dataTable" id="siteStockTable" style="width:100%;">
                                    <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>item Name</th>
                                        <th>Quantity</th>
                                        <th>Date</th>
                                        <th>Stock Type</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>SL</th>
                                        <th>item Name</th>
                                        <th>Quantity</th>
                                        <th>Date</th>
                                        <th>Stock Type</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <!-- Construction Site Stock End -->

                        <!-- Construction Site Accounts -->
                        <div class="tab-pane card-block" id="construction-site-accounts" role="tabpanel">
                            <div class="col-md-12 user-1 mb-1">
                                <div class="u-counters">
                                    <div class="row no-gutter" id="accounts-report">
                                        [Demo Accounts Report]
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                <button type="button" class="btn btn-primary col-xs-12 pull-right mb-1 " data-toggle="modal" data-target="#recordAccount">Record Accounts</button>
                            </div>
                            <div class="col-md-12 table-responsive">
                                <table class="table table-striped table-bordered" id="siteAccountsTable" style="width:100%;">
                                    <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                        <th>Type</th>
                                        <th>Note</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>SL</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                        <th>Type</th>
                                        <th>Note</th>
                                        <th>Action</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <!-- Construction Site Accounts End -->
                    </div>
                    <!--End Tab Content -->

                </div>
            </div>
        </div>
    </div>

</div>
<!-- Construction Site View End -->

<!-- Construction Site View  -->
<div class="box box-block bg-white" id="supply-site-view" style="display:none;">
    <div class="profile-header mb-1">
        <div class="profile-header-cover img-cover" style="background-image: url(<?php echo base_url('assets/');?>img/photos-1/1.jpg);"></div>
        <div class="profile-header-counters clearfix">
            <div class="container-fluid">
                <div class="float-xs-right">
                    <a href="#" class="text-black">
                        <h5 class="font-weight-bold">2k</h5>
                        <span class="text-muted">Supply</span>
                    </a>
                </div>
                <div class="float-xs-right">
                    <a href="#" class="text-black">
                        <h5 class="font-weight-bold">320</h5>
                        <span class="text-muted">Following</span>
                    </a>

                </div>
                <div class="float-xs-right">
                    <a href="#" class="text-black">
                        <h5 class="font-weight-bold">190</h5>
                        <span class="text-muted">Activities</span>
                    </a>
                </div>
            </div>
        </div>
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
            <div class="col-sm-8 col-md-9">
                <div class="card mb-0">
                    <ul class="nav nav-tabs nav-tabs-2 profile-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#profile" role="tab">Engineer</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#photos" role="tab">Photos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#friends" role="tab">Friends</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active table-responsive" id="profile" role="tabpanel">
                            <div class="col-md-12 mt-2">
                                <div class="box bg-white user-4 img-cover" style="background-image: url(<?php echo base_url('assets/')?>img/photos-1/1.jpg);">
                                    <div class="u-content">
                                        <h5><a class="text-white" href="#">[Default Name]</a></h5>
                                        <p class="mb-2">[Default Email]</p>
                                        <div class="avatar box-64 mb-2">
                                            <img class="b-a-radius-circle shadow-success" src="uploads" onerror="this.src='<?php echo base_url('uploads/system/default-user.jpg');?>'">
                                        </div>
                                        <div class="text-xs-center mt-0-5">
                                            <a class="btn btn-primary btn-rounded mx-0-5">Call Now</a>
                                            <a class="btn btn-outline-primary btn-rounded mx-0-5">Message</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane card-block" id="photos" role="tabpanel">
                            <div class="gallery-2 row">
                                <div class="col-md-4 col-sm-6 col-xs-6">
                                    <div class="g-item">
                                        <a href="<?php echo base_url('assets/');?>img/photos-1/1.jpg">
                                            <img src="<?php echo base_url('assets/');?>img/photos-1/1.jpg" alt="">
                                        </a>
                                        <div class="g-item-overlay clearfix">
                                            <div class="float-xs-left">
                                                <a class="text-white" href="#" data-toggle="modal" data-target="#likesModal"><i class="ti-heart mr-0-5"></i>105</a>
                                            </div>
                                            <div class="float-xs-right">
                                                <a class="text-white" href="#" data-toggle="modal" data-target="#likesModal"><i class="ti-comment mr-0-5"></i>20</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-6">
                                    <div class="g-item">
                                        <a href="<?php echo base_url('assets/');?>img/photos-1/2.jpg">
                                            <img src="<?php echo base_url('assets/');?>img/photos-1/2.jpg" alt="">
                                        </a>
                                        <div class="g-item-overlay clearfix">
                                            <div class="float-xs-left">
                                                <a class="text-white" href="#" data-toggle="modal" data-target="#likesModal"><i class="ti-heart mr-0-5"></i>105</a>
                                            </div>
                                            <div class="float-xs-right">
                                                <a class="text-white" href="#" data-toggle="modal" data-target="#likesModal"><i class="ti-comment mr-0-5"></i>20</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-6">
                                    <div class="g-item">
                                        <a href="<?php echo base_url('assets/');?>img/photos-1/3.jpg">
                                            <img src="<?php echo base_url('assets/');?>img/photos-1/3.jpg" alt="">
                                        </a>
                                        <div class="g-item-overlay clearfix">
                                            <div class="float-xs-left">
                                                <a class="text-white" href="#" data-toggle="modal" data-target="#likesModal"><i class="ti-heart mr-0-5"></i>105</a>
                                            </div>
                                            <div class="float-xs-right">
                                                <a class="text-white" href="#" data-toggle="modal" data-target="#likesModal"><i class="ti-comment mr-0-5"></i>20</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane card-block" id="friends" role="tabpanel">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6">
                                    <div class="box box-block mb-1">
                                        <div class="media">
                                            <div class="media-left">
                                                <div class="avatar box-48">
                                                    <img class="b-a-radius-circle" src="<?php echo base_url('assets/');?>img/avatars/8.jpg" alt="">
                                                    <i class="status bg-success bottom right"></i>
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="media-heading mt-0-5"><a class="text-black" href="#">John Doe</a></h6>
                                                <span class="font-90 text-muted">Software Engineer</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="box box-block mb-1">
                                        <div class="media">
                                            <div class="media-left">
                                                <div class="avatar box-48">
                                                    <img class="b-a-radius-circle" src="<?php echo base_url('assets/');?>img/avatars/9.jpg" alt="">
                                                    <i class="status bg-success bottom right"></i>
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="media-heading mt-0-5"><a class="text-black" href="#">John Doe</a></h6>
                                                <span class="font-90 text-muted">Software Engineer</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="box box-block mb-1">
                                        <div class="media">
                                            <div class="media-left">
                                                <div class="avatar box-48">
                                                    <img class="b-a-radius-circle" src="<?php echo base_url('assets/');?>img/avatars/10.jpg" alt="">
                                                    <i class="status bg-success bottom right"></i>
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="media-heading mt-0-5"><a class="text-black" href="#">John Doe</a></h6>
                                                <span class="font-90 text-muted">Software Engineer</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="box box-block">
                                        <div class="media">
                                            <div class="media-left">
                                                <div class="avatar box-48">
                                                    <img class="b-a-radius-circle" src="<?php echo base_url('assets/');?>img/avatars/1.jpg" alt="">
                                                    <i class="status bg-success bottom right"></i>
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="media-heading mt-0-5"><a class="text-black" href="#">John Doe</a></h6>
                                                <span class="font-90 text-muted">Software Engineer</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
                        <label>Site Type</label>
                        <select name="sitetype" class="form-control">
                            <option value="">Select Site Type</option>
                            <option value="Construction">Construction</option>
                            <option value="Supply">Supply</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Engineer</label>
                        <select name="engineerID" class="form-control select2" style="width:100%;">
                            <option value="">Select Engineer</option>
                            <?php if($engineer->num_rows() > 0):foreach($engineer->result() as $engi):?>
                            <option value="<?php echo $engi->ID;?>"><?php echo $engi->name;?></option>
                            <?php endforeach;endif;?>
                        </select>
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
                        <label>Site Type</label>
                        <select name="sitetype" class="form-control">
                            <option value="">Select Site Type</option>
                            <option value="Construction">Construction</option>
                            <option value="Supply">Supply</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Engineer</label>
                        <select name="engineerID" class="form-control select2" style="width:100%;">
                            <option value="">Select Engineer</option>
                            <?php if($engineer->num_rows() > 0):foreach($engineer->result() as $engi):?>
                                <option value="<?php echo $engi->ID;?>"><?php echo $engi->name;?></option>
                            <?php endforeach;endif;?>
                        </select>
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


<!-- Stock Add -->
<div class="modal fade" role="dialog" aria-labelledby="recordStock" aria-hidden="true" id="recordStock">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Record Stock</h4>
            </div>
            <form method="post" enctype="multipart/form-data" id="stockForm">
                <div class="modal-body">
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
                        <input type="text" class="form-control" placeholder="Quantity" name="quantity">
                    </div>
                    <div class="form-group">
                        <label>Stock Type</label>
                        <select name="stocktype" class="form-control">
                            <option value="">Select Stock Type</option>
                            <option value="Add">Add</option>
                            <option value="Drop">Drop</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Date</label>
                        <input type="text" class="form-control datepicker" placeholder="YYYY-MM-DD" name="date">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Record Stock</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Stock Add Ends -->


<!-- Stock Add -->
<div class="modal fade" role="dialog" aria-labelledby="recordStock" aria-hidden="true" id="recordAccount">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Add Transaction</h4>
            </div>
            <form method="post" enctype="multipart/form-data" id="transactionForm">
                <div class="modal-body">
                    <input type="hidden" name="siteID">
                    <div class="form-group">
                        <label>Amount</label>
                        <input type="text" class="form-control" placeholder="Amount" name="amount">
                    </div>
                    <div class="form-group">
                        <label>Date</label>
                        <input type="text" class="form-control datepicker" placeholder="YYYY-MM-DD" name="date">
                    </div>
                    <div class="form-group">
                        <label>Transaction Type</label>
                        <select name="transactiontype" class="form-control">
                            <option value="">Select Transaction Type</option>
                            <option value="Add Balance">Add Balance</option>
                            <option value="Expense">Expense</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Note</label>
                        <textarea type="text" class="form-control" row="5" placeholder="Note..." name="note"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Transaction</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Stock Add Ends -->