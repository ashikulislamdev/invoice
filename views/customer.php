<?php
    // Include Supplier API
    include 'api/customers.php';
?>

<div class="row">
	<div class="col-md-12 mx-auto">
		<button class="btn btn-primary my-2 font-weight-bold px-4" style="border-radius: 0px;" data-toggle="modal" data-target="#add_modal"> + Add New</button>
		<div class="card" style="border-radius: 0px;">
			<h4 class="bg-primary p-3">Customer List</h4>
			<div class="px-2" style="overflow: auto;">
				<table class="table table-striped table-hover text-center" style="min-width: 400px;" id="dataTable">
					<thead>
						<tr>
							<th class="text-center">SL No</th>
							<th class="text-center">Customer Name</th>
							<th class="text-center">Customer Phone</th>
							<th class="text-center">Action</th>
						</tr>
					</thead>
					<tbody>
                        <?php
                            if(isset($customersData) && (count($customersData) > 0)){
                                foreach ($customersData as $key => $value) {
                                    ?>
						<tr>
							<td><?php echo ++$key; ?></td>
							<td><?php echo $value['customer_name']; ?></td>
							<td><?php echo $value['customer_phone']; ?></td>
							<td class="action-col">
								<a href="#view_modal<?php echo $value['id']; ?>" data-toggle="modal" class="btn btn-sm bg-primary">View</a>
								<a href="#edit_modal<?php echo $value['id']; ?>" data-toggle="modal" class="btn btn-sm bg-success">Edit</a>
								<a href="#delete_modal<?php echo $value['id']; ?>" data-toggle="modal" class="btn btn-sm bg-danger">Delete</a>
							</td>
						</tr>

                        <!-- View Modal -->
                        <div class="modal fade" id="view_modal<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Customer Details</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>customer Name: <b><?php echo $value['customer_name']; ?></b></p>
                                        <hr>
                                        <p>customer Phone: <b><?php echo $value['customer_phone']; ?></b></p>
                                        <hr>
                                        <p>Address: <b><?php echo $value['address']; ?></b></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="edit_modal<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Update Customer Information</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="post" action="core/customer-edit.php">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <input type="hidden" name="customer_edit_id" value="<?php echo $value['id']; ?>" required readonly>
                                                    <div class="form-group">
                                                        <label for="customer_name" class="col-form-label">customer Name:</label>
                                                        <input type="text" class="form-control" name="customer_name" value="<?php echo $value['customer_name']; ?>" placeholder="Enter customer name" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="customer_phone" class="col-form-label">customer Phone:</label>
                                                        <input type="text" class="form-control" name="customer_phone" value="<?php echo $value['customer_phone']; ?>" placeholder="Enter customer phone" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="address" class="col-form-label">Address:</label>
                                                        <textarea name="address" style="min-height: 120px;" class="form-control" placeholder="Enter address"><?php echo $value['address']; ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <div class="row justify-content-center w-100">
                                                <div class="col-12 text-center">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save Change</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Delete Model -->
                        <div class="modal fade" id="delete_modal<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-body pt-5 pb-4 text-center">
                                        <i class="fa fa-trash text-danger" style="font-size: 50px;;"></i>
                                        <h4 class="text-danger pt-2 pb-3">Do you want to delete this record ?</h4>
                                        
                                        <a href="#" class="btn btn-secondary" data-dismiss="modal">Cancel</a>
                                        <a href="core/customer-delete.php?customer_id=<?php echo $value['id']; ?>" class="btn btn-danger">Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                                }
                            }else{
                                echo "<tr><td colspan='5' class='text-center text-danger'><h5>No Record Found..!</h5></td></tr>";
                            } 
                        ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>



<!-- Add Model -->
<div class="modal fade" id="add_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="core/customer-add.php">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="customer_name" class="col-form-label">Customer Name:</label>
                                <input type="text" class="form-control" name="customer_name" value="" placeholder="Enter customer name" required>
                            </div>
                            <div class="form-group">
                                <label for="customer_phone" class="col-form-label">customer Phone:</label>
                                <input type="text" class="form-control" name="customer_phone" placeholder="Enter customer phone" required>
                            </div>
                            <div class="form-group">
                                <label for="address" class="col-form-label">Address:</label>
                                <textarea name="address" style="min-height: 120px;" class="form-control" placeholder="Enter address"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row justify-content-center w-100">
                        <div class="col-12 text-center">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Change</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Add Model -->