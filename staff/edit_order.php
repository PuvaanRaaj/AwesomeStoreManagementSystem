<?php include('layouts/header.php'); ?>

<?php
if(isset($_GET['id'])){
  $orderId = $_GET['id'];
  $stmt = $conn->prepare("SELECT * FROM orders WHERE id=?");
  $stmt->bind_param('i',$orderId);
  $stmt->execute();
  $order = $stmt->get_result()->fetch_assoc();

  $stmt = $conn->prepare("SELECT * FROM products WHERE id=?");
  $stmt->bind_param('i',$order['product_id']);
  $stmt->execute();
  $product = $stmt->get_result()->fetch_assoc();

} else if(isset($_POST['edit_order'])){
    $order_status = $_POST['order_status'];
    $orderId = $_POST['order_id'];;
    $stmt = $conn->prepare("SELECT * FROM orders WHERE id=?");
    $stmt->bind_param('i',$orderId);
    $stmt->execute();
    $order = $stmt->get_result()->fetch_assoc();

    $stmt = $conn->prepare("SELECT * FROM products WHERE id=?");
    $stmt->bind_param('i',$order['product_id']);
    $stmt->execute();
    $product = $stmt->get_result()->fetch_assoc();

    $previous_status = $order['order_status'];
    $quantity = $order['order_quantity'];
    $productId = $product['id'];

    if($previous_status != 'delivered' && $order_status == 'delivered'){
        $stmt = $conn->prepare("UPDATE products SET stock_quantity=stock_quantity-? WHERE id=?");
        $stmt->bind_param('ii',$quantity,$productId);
        $stmt->execute();
    }
    else if($previous_status == 'delivered' && $order_status == 'order returned'){
        $stmt = $conn->prepare("UPDATE products SET stock_quantity=stock_quantity+? WHERE id=?");
        $stmt->bind_param('ii',$quantity,$productId);
        $stmt->execute();
    }

    $stmt = $conn->prepare("UPDATE orders SET order_status=? WHERE id=?");
    $stmt->bind_param('si',$order_status,$orderId);

    if($stmt->execute()){
        ?>
        <script>
          window.location.href="order.php?success=Order has been updated successfully"
        </script>
        <?php
    }else{
      ?>
        <script>
          window.location.href="order.php?error=Error occured, try again"
        </script>
        <?php
    }
} else {
  header('location: order.php');
  exit;
}
?>


<div class="container-fluid">
  <div class="row" style="min-height: 100%">
    <main class="col-md-9 ms-sm-auto col-lg-12 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Order</h1>
      </div>

      <div class="container">
        <form id="edit-order-form" method="POST" action="edit_order.php">
          <div class="mb-3">
            <label class="form-label"><strong>Order ID</strong> </label>
            <input type="text" class="form-control" value="<?php echo $order['id'];?>" disabled>
          </div> 

          <div class="mb-3">
            <label class="form-label">Shoppe Order Id</label>
            <input type="text" class="form-control" value="<?php echo $order['shoppe_order_id'];?>" disabled>
          </div>

          <div class="mb-3">
            <label class="form-label">Total Order Quantity</label>
            <input type="text" class="form-control" value="<?php echo $order['order_quantity'];?>" disabled>
          </div>

          <div class="mb-3">
            <label class="form-label">Order Price</label>
            <input type="text" class="form-control" value="<?php echo $order['total_price'];?>" disabled>
          </div>

          <div class="mb-3">
            <label class="form-label">Order Status</label>
            <select class="form-select" required name="order_status">
            <option value="paid" <?php if($order['order_status']=='not paid'){ echo "selected";}?> >Paid</option>
                <option value="shipped" <?php if($order['order_status']=='shipped'){ echo "selected";}?>>Shipped</option>
                <option value="delivered" <?php if($order['order_status']=='delivered'){ echo "selected";}?>>Delivered</option>
                <option value="order returned" <?php if($order['order_status']=='order returned'){ echo "selected";}?>>Order Returned</option>
                <option value="cancel" <?php if($order['order_status']=='cancel'){ echo "selected";}?>>Cancel</option>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Order Date</label>
            <input type="text" class="form-control" value="<?php echo $order['order_date'];?>" disabled>
          </div>

          <input type="hidden" name="order_id" value="<?php echo $order['id'];?>"/>
          <button type="submit" class="btn btn-primary" name="edit_order">Edit Order</button>
        </form>
      </div>
    </main>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
<script src="dashboard.js"></script>
</body>
</html>
