<?php
    // Include Cost API
    include 'api/cost.php';
?>

<div class="row">
	<div class="col-md-12 mx-auto">
		<button class="btn btn-primary my-2 font-weight-bold px-4" style="border-radius: 0px;" data-toggle="modal" data-target="#add_modal"> + Add New</button>
		<div class="card" style="border-radius: 0px;">
			<h4 class="bg-primary p-3">Cost List</h4>
			<div class="px-2" style="overflow: auto;">
				<table class="table table-striped table-hover text-center" style="min-width: 400px;">
					<thead>
						<tr>
							<th class="text-center">SL No</th>
							<th class="text-center">Title</th>
							<th class="text-center">Amount</th>
							<th class="text-center">Cost Type</th>
							<th class="text-center">Date</th>
							<th class="text-center">Action</th>
						</tr>
					</thead>
					<tbody>
                        <?php
                            if(isset($costData) && (count($costData) > 0)){
                                foreach ($costData as $key => $value) {
                                    ?>
						<tr>
							<td><?php echo ++$key; ?></td>
							<td><?php echo $value['title']; ?></td>
							<td><?php echo $value['amount']; ?> TK</td>
                            <td><?php echo $value['cost_type']; ?> </td>
							<td><?php echo $value['cost_date']; ?></td>
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
                                        <h5 class="modal-title" id="exampleModalLabel">cost Details</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Title: <b><?php echo $value['title']; ?></b></p>
                                        <hr>
                                        <p>Amount: <b><?php echo $value['amount']; ?> TK</b></p>
                                        <hr>
                                        <p>Cost Type: <b><?php echo $value['cost_type']; ?></b></p>
                                        <hr>
                                        <p>Date: <b><?php echo $value['cost_date']; ?></b></p>
                                        <hr>
                                        <p>Note: <b><?php echo $value['note']; ?></b></p>
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
                                        <h5 class="modal-title" id="exampleModalLabel">Update Supplier Information</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="post" action="core/cost-edit.php">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <input type="hidden" name="cost_edit_id" value="<?php echo $value['id']; ?>" required readonly>
                                                    <div class="form-group">
                                                        <label for="title" class="col-form-label">Title:</label>
                                                        <input type="text" class="form-control" name="title" value="<?php echo $value['title']; ?>" placeholder="Enter Title" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="amount" class="col-form-label">Amount:</label>
                                                        <input type="number" class="form-control" name="amount" value="<?php echo $value['amount']; ?>" placeholder="Enter  Amount (number)" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="cost_type" class="col-form-label">Cost Type:</label>
                                                        <select class="form-control" name="cost_type" required>
                                                            <option selected disabled>-- Select Cost Type --</option>                                                            
                                                            <option value="others">others</option>
                                                            <option value="Profit Withdrawal">Profit Withdrawal</option>                                                            
                                                            <option value="Loan Pay">Loan Pay</option>
                                                            <option value="Transport Cost">Transport Cost</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="cost_date" class="col-form-label">Date:</label>
                                                        <input type="date" class="form-control" name="cost_date" value="<?php echo $value['cost_date']; ?>" placeholder="Date" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="note" class="col-form-label">Note:</label>
                                                        <textarea name="note" style="min-height: 120px;" class="form-control" placeholder="Enter Note"><?php echo $value['note']; ?></textarea>
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
                                        <a href="core/cost-delete.php?cost_id=<?php echo $value['id']; ?>" class="btn btn-danger">Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                                }
                            }else{
                                echo "<tr><td colspan='5' class='text-center text-danger'><h5>No Data Found..!</h5></td></tr>";
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
                <h5 class="modal-title" id="exampleModalLabel">Add New Cost</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="core/cost-add.php">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="title" class="col-form-label">Title:</label>
                                <input type="text" class="form-control" name="title" value="" placeholder="Enter Title" required>
                            </div>
                            <div class="form-group">
                                <label for="amount" class="col-form-label">Amount:</label>
                                <input type="number" class="form-control" name="amount" placeholder="Enter  Amount (number)" required>
                            </div>
                            <div class="form-group">
                                <label for="cost_type" class="col-form-label">Cost Type:</label>
                                <select class="form-control" name="cost_type" required>
                                    <option selected disabled>-- Select Cost Type --</option>                                                            
                                        <option value="others">others</option>
                                        <option value="Profit Withdrawal">Profit Withdrawal</option>                                                            
                                        <option value="Loan Pay">Loan Pay</option>
                                        <option value="Transport Cost">Transport Cost</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="date" class="col-form-label">Date:</label>
                                <input type="date" class="form-control" name="cost_date" placeholder="Date" required>
                            </div>
                            <div class="form-group">
                                <label for="note" class="col-form-label">Note:</label>
                                <textarea name="note" style="min-height: 120px;" class="form-control" placeholder="Enter Note"></textarea>
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