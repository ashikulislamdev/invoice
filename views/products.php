<?php
    // Include Supplier API
    include 'api/suppliers.php';
?>

<div class="row">
	<div class="col-md-12 mx-auto">
		<button class="btn btn-primary my-2 font-weight-bold px-4" style="border-radius: 0px;" data-toggle="modal" data-target="#add_modal"> + Add New</button>
		<div class="card" style="border-radius: 0px;">
			<h4 class="bg-primary p-3">Product List</h4>
			<div class="px-2" style="overflow: auto;">
				<table class="table table-striped table-hover text-center" style="min-width: 400px;">
					<thead>
						<tr>
							<th class="text-center">SL No</th>
							<th class="text-center">Name</th>
							<th class="text-center">Quantity</th>
							<th class="text-center">Created Date</th>
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
							<td><?php echo $value['name']; ?></td>
							<td><?php echo $value['quantity']; ?></td>
							<td><?php echo $value['created']; ?></td>
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
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="core/product-add.php">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="col-form-label">Product Name:</label>
                                <input type="text" class="form-control" name="name" value="" placeholder="Product Name" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="quantity" class="col-form-label">Product Quantity:</label>
                                <input type="number" class="form-control" name="quantity" placeholder="Product Quantity (Number)" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="supplier_price" class="col-form-label">Supplier Price:</label>
                                <input type="number" class="form-control" name="supplier_price" placeholder="Product Supplier Price (Number)" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sale_price" class="col-form-label">Sale Price:</label>
                                <input type="number" class="form-control" name="sale_price" placeholder="Product Sale Price (Number)" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="voucher_no" class="col-form-label">Voucher No:</label>
                                <input type="number" class="form-control" name="voucher_no" placeholder="Product Voucher No (Number)" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="supplier_id" class="col-form-label">Supplier:</label>
                                <select name="supplier_id" id="supplier_id" class="form-control" required>
                                    <option value="">-- Select Supplier --</option>
                                    <?php
                                        if(isset($suppliersData)){
                                            foreach ($suppliersData as $key => $value) {
                                                echo "<option value='".$value['id']."'>".$value['supplier_name']."</option>";
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="warranty_days" class="col-form-label">Warranty Days:</label>
                                <input type="text" class="form-control" name="warranty_days" placeholder="Product Voucher No" required>
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