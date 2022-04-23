
<div class="container">
    <div class="card">
        <div class="card-body">
            <form class="row row-cols-lg-auto g-3">
                <div class="col-sm-4">
                    <select class="form-control" name="customer_name" required>
                        <option value="0">Select Customer</option>
                        <option value="1">Abul Kalam</option>
                        <option value="2">Abdul Kalek</option>
                    </select>
                </div>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="customer_phone" placeholder="Customer Phone" disabled />
                </div>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="customer_address" placeholder="Customer Address" disabled />
                </div>

                <table class="table table-border mt-3">
                    <thead class="">
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Discount</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <select class="form-control" name="customer_name" required>
                                    <option value="0">Select Customer</option>
                                    <option value="1">Abul Kalam</option>
                                    <option value="2">Abdul Kalek</option>
                                </select>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="product_price" placeholder="Product price" />
                            </td>
                            <td>
                                <input type="text" class="form-control" name="customer_qty" placeholder="Product qty" />
                            </td>
                            <td>
                                <input type="text" class="form-control" name="discount" placeholder="Discount" />
                            </td>
                            <td>
                                <input type="text" class="form-control" name="subtotal" placeholder="Subtotal" />
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>