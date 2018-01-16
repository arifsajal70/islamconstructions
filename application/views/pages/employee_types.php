<?php defined('BASEPATH') or exit('No DIrect script access allowed');?>
<div class="box box-block bg-white table-responsive" id="eng-table-view">
    <table class="table table-striped table-bordered dataTable" id="employeeTypeTable" style="width:100%;">
        <thead>
        <tr>
            <th>SL</th>
            <th>Employee Type</th>
            <th>Note</th>
            <th>Action</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>SL</th>
            <th>Employee Type</th>
            <th>Note</th>
            <th>Action</th>
        </tr>
        </tfoot>
    </table>
</div>

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
                <h4 class="modal-title" id="myModalLabel">Add Employee Type</h4>
            </div>
            <form id="addForm" action="<?php echo base_url('employee_types/add')?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Employee Type</label>
                        <input type="text" class="form-control" placeholder="Employee Type" name="type">
                    </div>
                    <div class="form-group">
                        <label>Note</label>
                        <textarea type="text" class="form-control" row="5" placeholder="Note" name="note"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Employee Type</button>
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
                <h4 class="modal-title" id="myModalLabel">Edit Employee Type</h4>
            </div>
            <form id="editForm" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Employee Type</label>
                        <input type="text" class="form-control" placeholder="Employee Type" name="type">
                    </div>
                    <div class="form-group">
                        <label>Note</label>
                        <textarea type="text" class="form-control" row="5" placeholder="Note" name="note"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Employee Type</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--Editing Modal Ends -->