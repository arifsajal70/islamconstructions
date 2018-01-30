<?php defined('BASEPATH') or exit('No DIrect script access allowed'); ?>
<?php if(isset($profile)):?>
<!-- Profile View  -->
<div class="box box-block bg-white" id="supply-site-view">
    <div class="profile-header mb-1">
        <div class="profile-header-cover img-cover"></div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4 col-md-3">
                <div class="card profile-card">
                    <div class="profile-avatar">
                        <img class="site-image" src="<?php echo base_url('uploads/'.$profile->photo) ;?>" width="100%" onerror="this.src='<?php echo base_url('uploads/system/default-construction.jpg');?>'">
                    </div>
                    <div class="card-block">
                        <h4 class="mb-0-25 site-name"><?php echo $profile->name ;?></h4>
                        <div class="text-muted mb-1 site-address"><?php echo $profile->address ;?></div>
                    </div>
                </div>
            </div>
            <div class="col-sm-8 col-md-9  mt-2">
                <div class="card mb-0">
                    <ul class="nav nav-tabs nav-tabs-2 profile-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#profile" role="tab">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#edit-profile" role="tab">Edit Profile</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#supply-site-managers" role="tab">Change Password</a>
						</li>
						<?php if($profile->usertype != "Admin"):?>
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#salary" role="tab">Salary</a>
						</li>
						<?php endif;?>
					</ul>
					<div class="tab-content">

                        <div class="tab-pane active card-block" id="profile" role="tabpanel">
							<div class="card">
								<table class="table">
									<tbody>
										<tr>
											<th>Name</th>
											<th>:</th>
											<td><?php echo $profile->name ;?></td>
										</tr>
										<tr>
											<th>Email</th>
											<th>:</th>
											<td><?php echo $profile->email ;?></td>
										</tr>
										<tr>
											<th>Phone</th>
											<th>:</th>
											<td><?php echo $profile->phone ;?></td>
										</tr>
										<tr>
											<th>Address</th>
											<th>:</th>
											<td><?php echo $profile->address ;?></td>
										</tr>
										<tr>
											<th>Joining Date</th>
											<th>:</th>
											<td><?php echo $profile->join_date ;?></td>
										</tr>
										<tr>
											<th>Salary</th>
											<th>:</th>
											<td><?php echo $profile->salary ;?></td>
										</tr>
										<tr>
											<th>Username</th>
											<th>:</th>
											<td><?php echo $profile->username ;?></td>
										</tr>
									</tbody>
								</table>
							</div>
                        </div>

                        <div class="tab-pane card-block" id="edit-profile" role="tabpanel">
							<form class="form" action="<?php echo base_url('profile/update_profile') ;?>" method="post" enctype="multipart/form-data">
								<div class="modal-body">
									<div class="form-group">
										<label>Name</label>
										<input type="text" class="form-control" placeholder="Name" name="name" value="<?php echo $profile->name ;?>">
									</div>
									<div class="form-group">
										<label>Email</label>
										<input type="text" class="form-control" placeholder="Email" disabled value="<?php echo $profile->email ;?>">
									</div>
									<div class="form-group">
										<label>Phone</label>
										<input type="text" class="form-control" placeholder="Phone" name="phone" value="<?php echo $profile->phone ;?>">
									</div>
									<div class="form-group">
										<label>Address</label>
										<textarea type="text" class="form-control" row="10" placeholder="Address" name="address"><?php echo $profile->address ;?></textarea>
									</div>
									<div class="form-group">
										<label>Username</label>
										<input type="text" class="form-control" placeholder="Username" name="username" value="<?php echo $profile->username ;?>">
									</div>
									<div class="form-group">
										<label>Photo</label>
										<input type="file" class="dropify" name="photo" data-default-file="<?= file_exists('./uploads/'.$profile->photo) ? base_url('uploads/'.$profile->photo) : "" ;?>">
									</div>
								</div>
								<div class="modal-footer">
									<button type="submit" class="btn btn-primary">Save Profile</button>
								</div>
							</form>
                        </div>

                        <div class="tab-pane card-block" id="supply-site-managers" role="tabpanel">
							<form action="<?php echo base_url('profile/change_password')?>" method="post" enctype="multipart/form-data">
								<div class="modal-body">
									<div class="form-group">
										<label>Current Password</label>
										<input type="text" class="form-control" placeholder="Current password" name="current_password">
									</div>
									<div class="form-group">
										<label>New Password</label>
										<input type="text" class="form-control" placeholder="New Password" name="new_password">
									</div>
									<div class="form-group">
										<label>Confirm Password</label>
										<input type="text" class="form-control" placeholder="Confirm Password" name="confirm_password">
									</div>
								</div>
								<div class="modal-footer">
									<button type="submit" class="btn btn-primary">Change Password</button>
								</div>
							</form>
                        </div>

						<?php if($profile->usertype != "Admin"):?>
                        <div class="tab-pane card-block" id="salary" role="tabpanel">
                            <div class="col-xs-12">
                                <button type="button" class="btn btn-primary col-xs-12 pull-right mb-1 " data-toggle="modal" data-target="#addCurrentWork">Add Current Work</button>
                            </div>
                            <div class="col-md-12 table-responsive">
                                <table class="table table-striped table-bordered" id="currentWorksTable" style="width:100%;">
                                    <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Vehicle</th>
                                        <th>Vehicle Name</th>
                                        <th>Vehicle Number</th>
                                        <th>Current Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
										<th>SL</th>
										<th>Vehicle</th>
										<th>Vehicle Name</th>
										<th>Vehicle Number</th>
										<th>Current Status</th>
										<th>Action</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
						<?php endif;?>

                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
<!-- Profile View End -->
<?php endif;?>
