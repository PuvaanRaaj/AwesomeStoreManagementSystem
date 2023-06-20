<?php include('layouts/header.php'); ?>

<div class="container-fluid">
  <div class="row">
    <main class="col-md-9 ms-sm-auto col-lg-12 px-md-4">
      <h3>Create Order</h3>

      <form id="create-form" enctype="multipart/form-data" method="POST" action="create_order.php">
        <!-- Shoppe Order ID -->
        <div class="form-group">
          <label for="shoppe_order_id">Shoppe Order ID:</label>
          <input type="text" id="shoppe_order_id" name="shoppe_order_id" class="form-control" required>
        </div>

        <!-- Order Status -->
        <div class="form-group">
        <label for="status">Order Status:</label>
        <select id="status" name="status" class="form-control" required>
            <option value="paid">Paid</option>
            <option value="packed">Packed</option>
            <option value="canceled">Canceled</option>
        </select>
        </div>


        <!-- Customer Name -->
        <div class="form-group">
          <label for="customer_name">Customer Name:</label>
          <input type="text" id="customer_name" name="customer_name" class="form-control" required>
        </div>

        <!-- Customer Email -->
        <div class="form-group">
          <label for="customer_email">Customer Email:</label>
          <input type="email" id="customer_email" name="customer_email" class="form-control" required>
        </div>

        <!-- Customer Address -->
        <div class="form-group">
          <label for="customer_address">Customer Address:</label>
          <input type="text" id="customer_address" name="customer_address" class="form-control" required>
        </div>

        <!-- Customer Number -->
        <div class="form-group">
          <label for="customer_number">Customer Number:</label>
          <input type="text" id="customer_number" name="customer_number" class="form-control" required>
        </div>

        <!-- Order Quantity -->
        <div class="form-group">
          <label for="order_quantity">Order Quantity:</label>
          <input type="number" id="order_quantity" name="order_quantity" class="form-control" required>
        </div>

        <!-- Product ID -->
        <div class="form-group mt-2">
                    <label>Product ID</label>
                    <?php
					$stmt2 = $conn->prepare("SELECT * FROM products");
                    $stmt2->execute();
                    $products = $stmt2->get_result();
					?>
					<select class="form-control" name="product_id">
					<option value="" disabled selected hidden>--- Choose Product ---</option>
                        <?php foreach($products as $product){?>  
								<option value='<?= $product['product_id']; ?>'><?= $product['product_name']; ?></option>
                        <?php }?>
					</select>
        </div>


        <!-- Total Price -->
        <div class="form-group">
          <label for="total_price">Total Price:</label>
          <input type="number" id="total_price" name="total_price" class="form-control" required>
        </div>

        <!-- Total Payment -->
        <div class="form-group">
          <label for="total_payment">Total Payment:</label>
          <input type="number" id="total_payment" name="total_payment" class="form-control" required>
        </div>

        <!-- Submit Button -->
        <div class="form-group">
          <input type="submit" class="btn btn-primary" name="create_order" value="Create">
        </div>
      </form>
    </main>
  </div>
</div>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
  </body>
</html>
