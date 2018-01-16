<?php defined('BASEPATH') or exit('No DIrect script access allowed');?>
<?php
    $this->cm->table_name = "usertypes";
    $types = $this->cm->get();
?>
<div class="box box-block bg-white table-responsive" id="eng-table-view">
    <table class="table table-striped table-bordered dataTable" id="employeesTable" style="width:100%;">
        <thead>
        <tr>
            <th>SL</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Image</th>
            <th>Working As</th>
            <th>Document</th>
            <th>Action</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>SL</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Image</th>
            <th>Working As</th>
            <th>Document</th>
            <th>Action</th>
        </tr>
        </tfoot>
    </table>
</div>

<!-- Profile  -->
<div class="box box-block bg-white" id="profile-view" style="display:none;">
    <div class="profile-header mb-1">
        <div class="profile-header-cover img-cover" style="background-image: url(<?php echo base_url('assets/');?>img/photos-1/1.jpg);"></div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4 col-md-3">
                <div class="card profile-card">
                    <div class="profile-avatar">
                        <img id="profile-image" width="100%" onerror="this.src='<?php echo base_url('uploads/system/default-user.jpg');?>'">
                    </div>
                    <div class="card-block">
                        <h4 class="mb-0-25" id="profile-name">John Doe</h4>
                        <div class="text-muted mb-1"  id="profile-email">default@email.com</div>
                        <a class="btn btn-primary btn-rounded waves-effect" id="profile-call-now">Call Now</a>
                    </div>
                    <ul class="list-group">
                        <a class="list-group-item" href="#">
                            <i class="ti-world mr-0-5"></i> example.com
                        </a>
                        <a class="list-group-item" href="#">
                            <i class="ti-facebook mr-0-5"></i> facebook.com/example
                        </a>
                        <a class="list-group-item" href="#">
                            <i class="ti-twitter mr-0-5"></i> twitter.com/example
                        </a>
                    </ul>
                </div>
            </div>
            <div class="col-sm-8 col-md-9 mt-2">
                <div class="card mb-0">
                    <ul class="nav nav-tabs nav-tabs-2 profile-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#profile" role="tab">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#photos" role="tab">Photos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#friends" role="tab">Friends</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="profile" role="tabpanel">

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
<!-- Profile end  -->

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
                <h4 class="modal-title" id="myModalLabel">Add Employee</h4>
            </div>
            <form id="addForm" action="<?php echo base_url('employees/add')?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" placeholder="Name" name="name">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" placeholder="Email" name="email">
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="tel" class="form-control" placeholder="Phone" name="phone">
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <textarea type="text" class="form-control" row="5" placeholder="Address" name="address"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Joining Date</label>
                        <input type="text" id="datepicker" class="form-control datepicker" placeholder="yyyy-mm-dd" name="join_date">
                    </div>
                    <div class="form-group">
                        <label>Salary</label>
                        <input type="text" class="form-control" placeholder="Salary" name="salary">
                    </div>
                    <div class="form-group">
                        <label>Working As</label>
                        <select name="usertype" class="form-control">
                            <option value="">Select Usertype</option>
                            <?php if($types->num_rows() > 0):foreach($types->result() as $type):?>
                            <option value="<?php echo $type->usertype;?>"><?php echo $type->usertype;?></option>
                            <?php endforeach;endif;?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Photo</label>
                        <input type="file" class="dropify" name="photo" data-allowed-file-extensions="png jpg jpeg">
                    </div>
                    <div class="form-group">
                        <label>Documents</label>
                        <input type="file" class="dropify" name="document" data-allowed-file-extensions="zip rar">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Employee</button>
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
                <h4 class="modal-title" id="myModalLabel">Edit Employee</h4>
            </div>
            <form id="editForm" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" placeholder="Name" name="name">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" placeholder="Email" name="email">
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="tel" class="form-control" placeholder="Phone" name="phone">
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <textarea type="text" class="form-control" row="5" placeholder="Address" name="address"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Joining Date</label>
                        <input type="text" id="datepicker" class="form-control datepicker" placeholder="yyyy-mm-dd" name="join_date">
                    </div>
                    <div class="form-group">
                        <label>Salary</label>
                        <input type="text" class="form-control" placeholder="Salary" name="salary">
                    </div>
                    <div class="form-group">
                        <label>Working As</label>
                        <select name="usertype" class="form-control">
                            <option value="">Select Usertype</option>
                            <?php if($types->num_rows() > 0):foreach($types->result() as $type):?>
                                <option value="<?php echo $type->usertype;?>"><?php echo $type->usertype;?></option>
                            <?php endforeach;endif;?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Photo</label>
                        <input type="file" class="dropify" name="photo" data-allowed-file-extensions="png jpg jpeg">
                    </div>
                    <div class="form-group">
                        <label>Documents</label>
                        <input type="file" class="dropify" name="document" data-allowed-file-extensions="zip rar">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Employee</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--Editing Modal Ends -->