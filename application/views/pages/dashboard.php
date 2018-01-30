<?php
if($this->session->usertype == "Admin" || $this->session->usertype == "Manager"):
	$this->cm->table_name = "sites";
	$sites = $this->cm->get();
elseif($this->session->usertype == "Site Manager"):
    $this->cm->table_name = "sitemanagers";
    $this->cm->join = array('sites'=>'sitemanagers.siteID=sites.ID');
    $this->cm->where = array('managerID'=>$this->session->ID);
    $sites = $this->cm->get();
elseif($this->session->usertype == "Engineer"):
    $this->cm->table_name = "sites";
    $this->cm->where = array('engineerID'=>$this->session->ID);
    $sites = $this->cm->get();
endif;

	$this->cm->reset_query();
	$this->cm->table_name = "engineers";
	$engineers = $this->cm->get();
	$this->cm->reset_query();
	$this->cm->table_name = "managers";
	$managers = $this->cm->get();
	$this->cm->reset_query();
	$this->cm->table_name = "employees";
	$employees = $this->cm->get();

?>
<?php if($this->session->usertype == "Admin"):?>
<div class="row row-md">
	<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
		<div class="box box-block tile tile-2 bg-danger mb-2">
			<div class="t-icon right"><i class="ti-paint-roller"></i></div>
			<div class="t-content">
				<h1 class="mb-1"><?php echo $sites->num_rows() ;?></h1>
				<h6 class="text-uppercase">Active Sites</h6>
			</div>
		</div>
	</div>

	<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
		<div class="box box-block tile tile-2 bg-success mb-2">
			<div class="t-icon right"><i class="ti-shopping-cart-full"></i></div>
			<div class="t-content">
				<h1 class="mb-1"><?php echo $engineers->num_rows() ;?></h1>
				<h6 class="text-uppercase">Engineers</h6>
			</div>
		</div>
	</div>

	<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
		<div class="box box-block tile tile-2 bg-primary mb-2">
			<div class="t-icon right"><i class="ti-shopping-cart-full"></i></div>
			<div class="t-content">
				<h1 class="mb-1"><?php echo $managers->num_rows() ;?></h1>
				<h6 class="text-uppercase">Managers</h6>
			</div>
		</div>
	</div>

	<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
		<div class="box box-block tile tile-2 bg-warning mb-2">
			<div class="t-icon right"><i class="ti-shopping-cart-full"></i></div>
			<div class="t-content">
				<h1 class="mb-1"><?php echo $employees->num_rows() ;?></h1>
				<h6 class="text-uppercase">Employees</h6>
			</div>
		</div>
	</div>
</div>
<?php endif;?>
<?php if($this->session->usertype == "Site Manager" || $this->session->usertype == "Engineer"):?>
    <div class="row row-md">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="box box-block tile tile-2 bg-success mb-2">
                <div class="t-icon right"><i class="ti-paint-roller"></i></div>
                <div class="t-content">
                    <h1 class="mb-1"><?php echo $sites->num_rows() ;?></h1>
                    <h6 class="text-uppercase">Active Sites</h6>
                </div>
            </div>
        </div>
    </div>
<?php endif;?>
<?php if($this->session->usertype == "Manager"):?>
    <div class="row row-md">
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="box box-block tile tile-2 bg-danger mb-2">
                <div class="t-icon right"><i class="ti-paint-roller"></i></div>
                <div class="t-content">
                    <h1 class="mb-1"><?php echo $sites->num_rows() ;?></h1>
                    <h6 class="text-uppercase">Active Sites</h6>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="box box-block tile tile-2 bg-success mb-2">
                <div class="t-icon right"><i class="ti-shopping-cart-full"></i></div>
                <div class="t-content">
                    <h1 class="mb-1"><?php echo $engineers->num_rows() ;?></h1>
                    <h6 class="text-uppercase">Engineers</h6>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="box box-block tile tile-2 bg-warning mb-2">
                <div class="t-icon right"><i class="ti-shopping-cart-full"></i></div>
                <div class="t-content">
                    <h1 class="mb-1"><?php echo $employees->num_rows() ;?></h1>
                    <h6 class="text-uppercase">Employees</h6>
                </div>
            </div>
        </div>
    </div>
<?php endif;?>
<div class="row row-md mb-2">
    <div class="col-md-12">
        <div class="card-block box bg-white">
            <table class="table table-grey-head mb-md-0" id="dataTables">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Site Created</th>
                        <?php if($this->session->usertype == "Admin"):?>
                        <th>Site Type</th>
                        <?php endif;?>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                <?php $n=1; if($sites->num_rows() > 0): foreach($sites->result() as $site):?>
                    <tr>
                        <th scope="row"><?php echo $n++ ;?></th>
                        <td><?php echo $site->name ;?></td>
                        <td><?php echo $site->address ;?></td>
                        <td><?php echo $site->created ;?></td>
                        <?php if($this->session->usertype == "Admin"):?>
                            <th><?php echo $site->sitetype ;?></th>
                        <?php endif;?>
                        <td><?php echo status_button($site->status) ;?></td>
                    </tr>
                <?php endforeach;endif;?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Site Created</th>
                        <?php if($this->session->usertype == "Admin"):?>
                            <th>Site Type</th>
                        <?php endif;?>
                        <th>Status</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
</div>