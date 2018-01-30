<div class="box box-block bg-white table-responsive" id="eng-table-view">
    <table class="table table-striped table-bordered" id="managersTable" style="width:100%;">
        <thead>
        <tr>
            <th>SL</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Image</th>
            <th>Working As</th>
            <th>Status</th>
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
            <th>Status</th>
            <th>Document</th>
            <th>Action</th>
        </tr>
        </tfoot>
    </table>
</div>

<!-- Profile  -->
<div class="box box-block bg-white" id="profile-view" style="display:none;">
    <div class="profile-header mb-1">
        <div class="profile-header-cover img-cover"></div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4 col-md-3">
                <div class="card profile-card">
                    <div class="profile-avatar">
                        <img id="profile-image" width="100%" onerror="this.src='<?php echo base_url('uploads/system/default-user.jpg');?>'">
                    </div>
                    <div class="card-block">
                        <h4 class="mb-0-25" id="profile-name">[ Default Name ]</h4>
                        <div class="text-muted mb-1"  id="profile-email">[ default@email.com ]</div>
                        <a class="btn btn-primary btn-rounded waves-effect" id="profile-call-now">Call Now</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-8 col-md-9 mt-2">
                <div class="card mb-0">
                    <ul class="nav nav-tabs nav-tabs-2 profile-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#profile" role="tab">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#workingHistory" role="tab">Working History</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#salary" role="tab">Salary</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="profile" role="tabpanel">
                            <div class="card-block">
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <th>Name</th>
                                        <th>:</th>
                                        <td for="name">[ XXXXXX XXXXXX ]</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <th>:</th>
                                        <td for="email">[ XXXXXXXX@XXXX.XXX ]</td>
                                    </tr>
                                    <tr>
                                        <th>Phone</th>
                                        <th>:</th>
                                        <td for="phone">[ XXX-XXX XXXXX ]</td>
                                    </tr>
                                    <tr>
                                        <th>Address</th>
                                        <th>:</th>
                                        <td for="address">[ XXXXXXXXXXXXXXX.............. ]</td>
                                    </tr>
                                    <tr>
                                        <th>Joining Date</th>
                                        <th>:</th>
                                        <td for="join_date">[ YYYY-MM-DD ]</td>
                                    </tr>
                                    <tr>
                                        <th>Salary</th>
                                        <th>:</th>
                                        <td for="salary">[ XXXX.XX ]</td>
                                    </tr>
                                    <tr>
                                        <th>Username</th>
                                        <th>:</th>
                                        <td for="username">[ XXXXXXXXXX ]</td>
                                    </tr>
                                    <tr>
                                        <th>Working As</th>
                                        <th>:</th>
                                        <td for="usertype">[ XXXXXXXXXX ]</td>
                                    </tr>
                                    <tr>
                                        <th>Document</th>
                                        <th>:</th>
                                        <td><button type="button" for="document" class="btn btn-info btn-sm waves-effect waves-light"><i class="ti-download"></i> Download</button></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="tab-pane card-block" id="workingHistory" role="tabpanel">
                            <div class="col-md-12 table-responsive">
                                <table class="table table-striped table-bordered" id="workHistoryTable" style="width:100%;">
                                    <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Site Name</th>
                                        <th>Site Address</th>
                                        <th>Site Status</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>SL</th>
                                        <th>Site Name</th>
                                        <th>Site Address</th>
                                        <th>Site Status</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                        <div class="tab-pane card-block" id="salary" role="tabpanel">
                            <div class="col-xs-12">
                                <form id="manager_salary_generation" method="post">
                                    <button type="submit" class="btn btn-primary col-xs-12 pull-right mb-1 ">Generate Salary</button>
                                </form>
                            </div>
                            <div class="col-md-12 table-responsive">
                                <table class="table table-striped table-bordered" id="salaryTable" style="width:100%;">
                                    <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>SL</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Date</th>
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
                <h4 class="modal-title" id="myModalLabel">Add Manager</h4>
            </div>
            <form id="addForm" action="<?php echo base_url('managers/add')?>" method="post" enctype="multipart/form-data">
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
                        <input type="text" class="form-control datepicker" placeholder="yyyy-mm-dd" name="join_date">
                    </div>
                    <div class="form-group">
                        <label>Salary</label>
                        <input type="text" class="form-control" placeholder="Salary" name="salary">
                    </div>
                    <div class="form-group">
                        <label>Working As</label>
                        <select name="usertype" class="form-control">
                            <option value="">Select User Type</option>
                            <option value="Manager">Manager</option>
                            <option value="Site Manager">Site Manager</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" placeholder="Username" name="username">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" placeholder="Password" name="password">
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" class="form-control" placeholder="Confirm Password" name="cpassword">
                    </div>
                    <div class="form-group">
                        <label>Photo</label>
                        <input type="file" class="dropify" name="photo">
                    </div>
                    <div class="form-group">
                        <label>Documents</label>
                        <input type="file" class="dropify" name="document">
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
                <h4 class="modal-title" id="myModalLabel">Edit Manager</h4>
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
                        <input type="text" class="form-control datepicker" placeholder="yyyy-mm-dd" name="join_date">
                    </div>
                    <div class="form-group">
                        <label>Salary</label>
                        <input type="text" class="form-control" placeholder="Salary" name="salary">
                    </div>
                    <div class="form-group">
                        <label>Working As</label>
                        <select name="usertype" class="form-control">
                            <option value="">Select User Type</option>
                            <option value="Manager">Manager</option>
                            <option value="Site Manager">Site Manager</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" placeholder="Username" name="username">
                    </div>
                    <div class="form-group">
                        <label>Photo</label>
                        <input type="file" class="dropify" name="photo">
                    </div>
                    <div class="form-group">
                        <label>Documents</label>
                        <input type="file" class="dropify" name="document">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Manager</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--Editing Modal Ends -->

<button data-toggle="modal" data-target="#passChangeModal" style="display:none;"></button>
<!-- Password Change Modal -->
<div class="modal fade" role="dialog" aria-labelledby="passChangeModal" aria-hidden="true" id="passChangeModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Change Password</h4>
            </div>
            <form id="passchange" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" placeholder="Password" name="password">
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" class="form-control" placeholder="Confirm Password" name="cpassword">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Change password</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--Password Change Modal Ends -->