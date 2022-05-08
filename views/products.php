<?php
    // Include Supplier API
    include 'api/suppliers.php';
    // Include Product API
    include 'api/products.php';
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
                            if(isset($productsData) && (count($productsData) > 0)){
                                foreach ($productsData as $key => $value) {
                                    if ($value['quantity'] != 0) {
                                        ?>
						<tr>
							<td><?php echo ++$key; ?></td>
							<td><?php echo $value['name']; ?></td>
							<td><?php echo $value['quantity']; ?></td>
							<td><?php echo  date("jS F, Y", strtotime($value['created'])); ?></td>
							<td class="action-col">
								<a href="#view_modal<?php echo $value['id']; ?>" data-toggle="modal" class="btn btn-sm bg-primary">View</a>
								<button data-toggle="modal" data-target="#edit_modal<?php echo $value['id']; ?>" class="btn btn-sm bg-success" disabled>Edit</button>
								<a href="#delete_modal<?php echo $value['id']; ?>" data-toggle="modal" class="btn btn-sm bg-danger">Delete</a>
							</td>
						</tr>

                        <!-- View Modal -->
                        <div class="modal fade" id="view_modal<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Product Details</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>product Name: <b><?php echo $value['name']; ?></b></p>
                                        <hr>
                                        <p>Quantity: <b><?php echo $value['quantity']; ?></b></p>
                                        <hr>
                                        <p>Supplier Price: <b><?php echo $value['supplier_price']; ?> TK</b></p>
                                        <hr>
                                        <p>Sale Price: <b><?php echo $value['sale_price']; ?> TK</b></p>
                                        <hr>
                                        <p>Voucher No: <b><?php echo $value['voucher_no']; ?></b></p>
                                        <hr>
                                        <p>
                                            Supplier Name:
                                            <b>
                                                <?php
                                                    $supplier_view_id = $value['supplier_id'];
                                                    if(isset($suppliersData)){
                                                        foreach ($suppliersData as $supplierView) {
                                                            if($supplier_view_id == $supplierView['id'] ){
                                                                echo $supplierView['supplier_name'];
                                                                break;
                                                            }
                                                        }
                                                    }
                                                ?>
                                            </b>
                                        </p>
                                        <hr>
                                        <p>Warranty Days: <b><?php echo $value['warranty_days']; ?></b></p>
                                        <hr>
                                        <p>Created: <b><?php echo $value['created']; ?></b></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="edit_modal<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Update product Information</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="post" action="core/product-edit.php">
                                        <div class="modal-body">
                                            <div class="row">
                                                <input type="hidden" name="product_edit_id" value="<?php echo $value['id']; ?>" required readonly>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="name" class="col-form-label">Product Name:</label>
                                                        <input type="text" class="form-control" name="name" value="<?php echo $value['name']; ?>" placeholder="Product Name" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="quantity" class="col-form-label">Product Quantity:</label>
                                                        <input type="number" class="form-control" name="quantity" value="<?php echo $value['quantity']; ?>" placeholder="Product Quantity (Number)" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="supplier_price" class="col-form-label">Supplier Price:</label>
                                                        <input type="number" class="form-control" name="supplier_price" value="<?php echo $value['supplier_price']; ?>" placeholder="Product Supplier Price (Number)" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="sale_price" class="col-form-label">Sale Price:</label>
                                                        <input type="number" class="form-control" name="sale_price" value="<?php echo $value['sale_price']; ?>" placeholder="Product Sale Price (Number)" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="voucher_no" class="col-form-label">Voucher No:</label>
                                                        <input type="text" class="form-control" name="voucher_no" value="<?php echo $value['voucher_no']; ?>" placeholder="Product Voucher No (Number)" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="supplier_id" class="col-form-label">Supplier:</label>
                                                        <select name="supplier_id" id="supplier_id" class="form-control" required>
                                                            <option value="">-- Select Supplier --</option>
                                                            <?php
                                                                $supplier_id = $value['supplier_id'];
                                                                if(isset($suppliersData)){
                                                                    foreach ($suppliersData as $supplier) {
                                                                        $supplier_find = null;
                                                                        if($supplier_id == $supplier['id'] ){
                                                                            $supplier_find = 'selected';
                                                                        }
                                                                        echo "<option value='".$supplier['id']."' ".$supplier_find.">".$supplier['supplier_name']."</option>";
                                                                    }
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="warranty_days" class="col-form-label">Warranty Days:</label>
                                                        <input type="text" class="form-control" name="warranty_days" value="<?php echo $value['warranty_days']; ?>" placeholder="Product Voucher No" required>
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
                                        <a href="core/product-delete.php?product_id=<?php echo $value['id']; ?>" class="btn btn-danger">Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                                    }else{
                                        echo "<tr><td colspan='5' class='text-center text-danger'><h5>No Record Found..!</h5></td></tr>";
                                    }
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
                                <input type="text" class="form-control" name="voucher_no" placeholder="Product Voucher No (Number)" required>
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
                                <input type="text" class="form-control" name="warranty_days" placeholder="Product Warranty day" required>
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