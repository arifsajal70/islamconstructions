<?php defined('BASEPATH') or exit('No DIrect script access allowed');?>
<div class="box box-block bg-white table-responsive" id="eng-table-view">
    <table class="table table-striped table-bordered dataTable" id="itemsTable" style="width:100%;">
        <thead>
        <tr>
            <th>SL</th>
            <th>Item Name</th>
            <th>Item Unite</th>
            <th>Price Per Unit</th>
            <th>Action</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>SL</th>
            <th>Item Name</th>
            <th>Item Unite</th>
            <th>Price Per Unit</th>
            <th>Action</th>
        </tr>
        </tfoot>
    </table>
</div>

<button class="btn btn-success btn-circle btn-lg btn-float-right" data-toggle="modal" data-target="#addingModal"><i class="ti-plus"></i></button>

<!--Adding Modal -->
<div class="modal fade" role="dialog" aria-labelledby="addingModal" aria-hidden="true" id="addingModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Add Item</h4>
            </div>
            <form id="addForm" action="<?php echo base_url('items/add')?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" placeholder="Name" name="name">
                    </div>
                    <div class="form-group">
                        <label>Unit</label>
                        <input type="text" class="form-control" placeholder="Unit" name="unit">
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <input type="number" class="form-control" placeholder="Price Per Unit" name="price">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Item</button>
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
                <h4 class="modal-title" id="myModalLabel">Edit Item</h4>
            </div>
            <form id="editForm" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" placeholder="Name" name="name">
                    </div>
                    <div class="form-group">
                        <label>Unit</label>
                        <input type="text" class="form-control" placeholder="Unit" name="unit">
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <input type="number" class="form-control" placeholder="Price Per Unit" name="price">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Item</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--Editing Modal Ends -->