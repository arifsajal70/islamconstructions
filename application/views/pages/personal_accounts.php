<div class="box box-block bg-white table-responsive">
	<ul class="nav nav-tabs" role="tablist">
		<li class="nav-item">
			<a class="nav-link active" data-toggle="tab" href="#balanceAdded" role="tab">Balance Added</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" data-toggle="tab" href="#expensed" role="tab">Expensed</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" data-toggle="tab" href="#report" role="tab">Reports</a>
		</li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane active" id="balanceAdded" role="tabpanel">
			<div class="card-block">
				<div class="col-xs-12">
					<button type="button" class="btn btn-primary col-xs-12 pull-right mb-1 " data-toggle="modal" data-target="#addBalance">Add Balance</button>
				</div>
				<div class="col-md-12 table-responsive">
					<table class="table table-striped table-bordered" id="addBalanceTable" style="width:100%;">
						<thead>
						<tr>
							<th>SL</th>
							<th>Title</th>
							<th>Date</th>
							<th>Item</th>
							<th>Rate</th>
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
							<th>Rate</th>
							<th>Download</th>
							<th>Action</th>
						</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
		<div class="tab-pane" id="expensed" role="tabpanel">
			<div class="card-block">
				<div class="col-xs-12">
					<button type="button" class="btn btn-primary col-xs-12 pull-right mb-1 " data-toggle="modal" data-target="#addExpense">Add Expense</button>
				</div>
				<div class="col-md-12 table-responsive">
					<table class="table table-striped table-bordered" id="expenseTable" style="width:100%;">
						<thead>
						<tr>
							<th>SL</th>
							<th>Title</th>
							<th>Date</th>
							<th>Item</th>
							<th>Quantity</th>
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
							<th>Download</th>
							<th>Action</th>
						</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
		<div class="tab-pane" id="report" role="tabpanel">
			<div class="card-block">
				<div class="chart-container demo-chart">
					<div id="accounts-chart" class="chart-placeholder"></div>
				</div>
			</div>
		</div>

	</div>
</div>

<!--Adding Modal -->
<div class="modal fade" role="dialog" aria-labelledby="addBalance" aria-hidden="true" id="addBalance">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Add Balance</h4>
			</div>
			<form id="addForm" action="<?php echo base_url('personal_accounts/add_balance')?>" method="post" enctype="multipart/form-data">
				<input type="hidden" name="sitetype" value="Supply">
				<div class="modal-body">
					<div class="form-group">
						<label>Title</label>
						<input type="text" class="form-control" placeholder="Title" name="title">
					</div>
					<div class="form-group">
						<label>Amount</label>
						<input type="text" class="form-control" placeholder="Amount" name="amount">
					</div>
					<div class="form-group">
						<label>Note</label>
						<textarea type="text" class="form-control" row="5" placeholder="Note" name="note"></textarea>
					</div>
					<div class="form-group">
						<label>Date</label>
						<input type="text" class="form-control datepicker" placeholder="yyyy-mm-dd" name="date">
					</div>
					<div class="form-group">
						<label>Document</label>
						<input type="file" class="dropify" name="document">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Add Balance</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!--Adding Modal Ends -->

<!--Adding Modal -->
<button data-toggle="modal" data-target="#editBalance" style="display:none;"></button>
<div class="modal fade" role="dialog" aria-labelledby="editBalance" aria-hidden="true" id="editBalance">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Save Balance</h4>
			</div>
			<form id="editForm" method="post" enctype="multipart/form-data">
				<input type="hidden" name="sitetype" value="Supply">
				<div class="modal-body">
					<div class="form-group">
						<label>Title</label>
						<input type="text" class="form-control" placeholder="Title" name="title">
					</div>
					<div class="form-group">
						<label>Amount</label>
						<input type="text" class="form-control" placeholder="Amount" name="amount">
					</div>
					<div class="form-group">
						<label>Note</label>
						<textarea type="text" class="form-control" row="5" placeholder="Note" name="note"></textarea>
					</div>
					<div class="form-group">
						<label>Date</label>
						<input type="text" class="form-control datepicker" placeholder="yyyy-mm-dd" name="date">
					</div>
					<div class="form-group">
						<label>Document</label>
						<input type="file" class="dropify" name="document">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save Balance</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!--Adding Modal Ends -->

<!--Adding Modal -->
<div class="modal fade" role="dialog" aria-labelledby="addExpense" aria-hidden="true" id="addExpense">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
				<h4 class="modal-title" id="myModalLabel">Add Expense</h4>
			</div>
			<form id="addForm" action="<?php echo base_url('personal_accounts/add_expense')?>" method="post" enctype="multipart/form-data">
				<input type="hidden" name="sitetype" value="Supply">
				<div class="modal-body">
					<div class="form-group">
						<label>Title</label>
						<input type="text" class="form-control" placeholder="Title" name="title">
					</div>
					<div class="form-group">
						<label>Amount</label>
						<input type="text" class="form-control" placeholder="Amount" name="amount">
					</div>
					<div class="form-group">
						<label>Note</label>
						<textarea type="text" class="form-control" row="5" placeholder="Note" name="note"></textarea>
					</div>
					<div class="form-group">
						<label>Date</label>
						<input type="text" class="form-control datepicker" placeholder="yyyy-mm-dd" name="date">
					</div>
					<div class="form-group">
						<label>Document</label>
						<input type="file" class="dropify" name="document">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Add Expense</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!--Adding Modal Ends -->
