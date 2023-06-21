<?php include('layouts/header.php'); ?>

<div class="container-fluid">
  <div class="row" style="min-height: 100%">

  <main class="col-md-9 ms-sm-auto col-lg-12 px-md-4">
      <div class="row">
           <div class="col-12">
               <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                   <h3 class="mb-sm-0 pt-5">Create Order</h3>
                   <div class="page-title-right menu">
                       <ol class="breadcrumb pt-5">
                           <li class="breadcrumb-item">Awesome Store</li>
                           <li class="breadcrumb-item active">Orders</li>
                       </ol>
                   </div>
               </div>

           </div>
       </div>
      <div class="table-responsive">

                <div class="mx-auto container">
                    <form id="create-form" method="POST" action="create_order.php">
                        <p style="color: red;"><?php if(isset($_GET['error'])){ echo $_GET['error']; }?></p>
                        <div class="form-group mt-2">
                            <label>Shopee Order ID</label>
                            <input type="text" class="form-control" name="shoppe_order_id" placeholder="Please enter the Shopee order ID" required/>
                        </div>
                        <div class="form-group mt-2">
                            <label>Order Status</label>
                            <select class="form-control" name="order_status" required>
                                <option value="" disabled selected hidden>--- Choose Status ---</option>
                                <option value="paid">Paid</option>
                                <option value="canceled">Canceled</option>
                                <option value="processing">Processing</option>
                            </select>
                        </div>

                        <div class="form-group mt-2">
                            <label>Product ID</label>
                            <?php
                                $stmt = $conn->prepare("SELECT * FROM products");
                                $stmt->execute();
                                $products = $stmt->get_result();
                            ?>
                            <select class="form-control" name="product_id" required>
                                <option value="" disabled selected hidden>--- Choose Product ---</option>
                                <?php foreach($products as $product){?>  
                                    <option value='<?= $product['id']; ?>'><?= $product['product_name']; ?></option>
                                <?php }?>
                            </select>
                        </div>

                        <div class="form-group mt-2">
                            <label>Customer Name</label>
                            <input type="text" class="form-control" name="customer_name" placeholder="Please enter the customer's name" required/>
                        </div>
                        <div class="form-group mt-2">
                            <label>Customer Email</label>
                            <input type="email" class="form-control" name="customer_email" placeholder="Please enter the customer's email" required/>
                        </div>
                        <div class="form-group mt-2">
                            <label>Customer Address</label>
                            <input type="text" class="form-control" name="customer_address" placeholder="Please enter the customer's address" required/>
                        </div>
                        <div class="form-group mt-2">
                            <label>Customer Number</label>
                            <input type="text" class="form-control" name="customer_number" placeholder="Please enter the customer's contact number" required/>
                        </div>
                        <div class="form-group mt-2">
                            <label>Order Quantity</label>
                            <input type="number" class="form-control" name="order_quantity" min="1" placeholder="Please enter the quantity of the order" required/>
                        </div>
                        <div class="form-group mt-2">
                            <label>Total Price</label>
                            <input type="number" class="form-control" name="total_price" min="0" placeholder="Please enter the total price of the order" required/>
                        </div>
                        <div class="form-group mt-2">
                            <label>Total Payment</label>
                            <input type="number" class="form-control" name="total_payment" min="0" placeholder="Please enter the total payment for the order" required/>
                        </div>
                        <div class="form-group mt-3">
                            <input type="submit" class="btn btn-primary" name="create_order" value="Create Order"/>
                        </div>
                    </form>
                </div>

      </div>
    </main>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Retrieve the form by its ID
    var form = document.getElementById('create-form');

    // Add a submit event listener
    form.addEventListener('submit', function(event) {
        // Retrieve the form field values
        var shoppeOrderId = form['shoppe_order_id'].value;
        var orderStatus = form['order_status'].value;
        var productId = form['product_id'].value;
        var customerName = form['customer_name'].value;
        var customerEmail = form['customer_email'].value;
        var customerAddress = form['customer_address'].value;
        var customerNumber = form['customer_number'].value;
        var orderQuantity = form['order_quantity'].value;
        var totalPrice = form['total_price'].value;
        var totalPayment = form['total_payment'].value;

        // Check if any of the fields are empty
        if (!shoppeOrderId || !orderStatus || !productId || !customerName || !customerEmail || !customerAddress || !customerNumber || !orderQuantity || !totalPrice || !totalPayment) {
            Swal.fire({
                icon: 'warning',
                title: 'Input Required',
                text: 'Please fill all fields.'
            });
            event.preventDefault();
            return false;
        }

        // Check email format
        var emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
        if (!customerEmail.match(emailPattern)) {
            Swal.fire({
                icon: 'warning',
                title: 'Invalid Email',
                text: 'Please enter a valid email.'
            });
            event.preventDefault();
            return false;
        }

        // Validate customer name - allow only alphanumeric and spaces, disallow special characters
        var namePattern = /^[a-zA-Z0-9 ]*$/;
        if (!customerName.match(namePattern)) {
            Swal.fire({
                icon: 'warning',
                title: 'Invalid Customer Name',
                text: 'Special characters are not allowed.'
            });
            event.preventDefault();
            return false;
        }

        // Validate customer number - must start with 0
        if (customerNumber.charAt(0) !== '0') {
            Swal.fire({
                icon: 'warning',
                title: 'Invalid Customer Number',
                text: 'Must start with "0".'
            });
            event.preventDefault();
            return false;
        } 

        // Check numerical values
        if (isNaN(productId) || isNaN(orderQuantity) || isNaN(totalPrice) || isNaN(totalPayment)) {
            Swal.fire({
                icon: 'warning',
                title: 'Invalid Numerical Value',
                text: 'Please provide valid numerical values for Product ID, Order Quantity, Total Price, and Total Payment.'
            });
            event.preventDefault();
            return false;
        }
    });
</script>



<script>
    // Parse the URL parameters
    const urlParams = new URLSearchParams(window.location.search);

    // If an order was created successfully
    if (urlParams.has('order_created')) {
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: urlParams.get('order_created')
        });
    }

    // If there was an error creating the order
    if (urlParams.has('order_failed')) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: urlParams.get('order_failed')
        });
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
  
</body>
</html>
