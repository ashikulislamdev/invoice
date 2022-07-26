
<?php
    // Include Invoice API
    include 'api/invoices.php';
    // Include Customer API
    include 'api/customers.php';
?>

<div class="row">
	<div class="col-md-12 mx-auto">
		<a class="btn btn-primary my-2 font-weight-bold px-4" style="border-radius: 0px;" href="new-invoice.php"> New Invoice</a>
		<div class="card" style="border-radius: 0px;">
			<h4 class="bg-primary p-3">Invoice List</h4>
			<div class="px-2" style="overflow: auto;">
				<table class="table table-striped table-hover text-center" style="min-width: 400px;">
					<thead>
						<tr>
							<th class="text-center">Invoice ID</th>
							<th class="text-center">Customer Name</th>
							<th class="text-center">Amount</th>
							<th class="text-center">Due</th>
							<th class="text-center">Date</th>
							<th class="text-center">Action</th>
						</tr>
					</thead>
					<tbody id="dataTable">
                        <?php
                            if(isset($invoiceData) && (count($invoiceData) > 0)){
                                foreach ($invoiceData as $key => $value) {
                                    ?>
						<tr>
							<td>
								<?php
									echo "#" . $value['id'];

									if($value['due'] > 0){
										echo "<span style='display: none;'> due</span>";
									}
								?>
							</td>
							<td>
								<?php
									$customer_id = $value['customer_id'];
									if(isset($customersData)){
										foreach ($customersData as $customerInfo) {
											if($customer_id == $customerInfo['id'] ){
												echo $customerInfo['customer_name'];
												break;
											}
										}
									}
								?>
							</td>
							<td><?php echo $value['total']; ?> TK</td>
							<td><?php echo $value['due']; ?> TK</td>
							<td><?php echo date('d M Y', strtotime($value['created'])) ?></td>
							<td class="action-col">
								<a href="invoice-details.php?invoice_id=<?php echo $value['id']; ?>" class="btn btn-sm bg-primary">View</a>
								<a href="#edit_modal<?php echo $value['id']; ?>" data-toggle="modal" class="btn btn-sm bg-success">Pay Amount</a>
								<!-- <a href="#edit_modal<?php echo $value['id']; ?>" data-toggle="modal" class="btn btn-sm bg-success">Edit</a> -->
								<a href="#delete_modal<?php echo $value['id']; ?>" data-toggle="modal" class="btn btn-sm bg-danger">Delete</a>
							</td>
						</tr>
							

						<!-- Edit Modal -->
							<div class="modal fade" id="edit_modal<?php echo $value['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Update Due</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<form method="post" action="core/invoice-edit.php">
											<div class="modal-body">
												<div class="row">
													<div class="col-12">
														<input type="hidden" name="invoice_id" value="<?php echo $value['id']; ?>" required readonly>
														
														<div class="form-group">
															<label for="pay" class="col-form-label">Amount:</label>
															<input type="number" class="form-control" name="pay" value="<?php echo $value['pay']; ?>" placeholder="Enter  Amount (number)" required>
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
						
                        <?php }} ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>








<!-- 
			$(document).ready(function(){
                var count = 1;
                $('#add_btn').click(function(e){
                    e.preventDefault();
                    count = count + 1;
                    $("#add_row").append('<div class="row px-4 py-2" id="row_section'+count+'"><div class="col-md-6 pt-2"><label class="text-primary"><b>পার্টিকুলার <span class="text-danger">*</span></b></label><input type="text" maxlength="250" name="particular[]" class="form-control border-primary" style="border: 2px solid; border-radius: 0px;" placeholder="পার্টিকুলার" required></div><div class="col-md-4 pt-2"><label class="text-primary"><b>টাকার পরিমান (ইংরেজি) <span class="text-danger">*</span></b></label><input type="number" maxlength="11" name="taka[]" class="form-control border-primary" style="border: 2px solid; border-radius: 0px;" placeholder="টাকার পরিমান (ইংরেজি)" required></div><div class="col-md-2 text-center pt-2"><br><button type="button" name="remove" data-row="row_section'+count+'" class="btn btn-danger btn-sm remove mt-3"><span class="fa fa-trash"></span></button></div>');
                });
                $(document).on("click", ".remove", function(a){
                    a.preventDefault();
                    var delete_row = $(this).data("row");
                    $('#' + delete_row).remove();
                });
            });
		 -->