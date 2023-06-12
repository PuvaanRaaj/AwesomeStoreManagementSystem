<?php include('layouts/header.php'); ?>

<?php
if(isset($_GET['id'])){
  $id = $_GET['id'];
  $stmt = $conn->prepare("SELECT * FROM orders WHERE id=?");
  $stmt->bind_param('i',$id);
  $stmt->execute();
  $order = $stmt->get_result(); //[]

}  else if(isset($_POST['edit_order'])){

          $order_status = $_POST['order_status'];
          $id = $_POST['id'];
          $stmt = $conn->prepare("SELECT * FROM orders WHERE id=?");
          $stmt->bind_param('i',$id);
          $stmt->execute();
          $order = $stmt->get_result(); //[]

          foreach($order as $r){
            $previous_status = $r['order_status'];
            $quantity = $r['order_quantity'];
            $id = $r['product_id'];
          };

          if($previous_status!='delivered'){

            if($order_status == 'delivered'){
              $stmt = $conn->prepare("UPDATE products SET stock_quantity=stock_quantity-? WHERE id=?");
              $stmt->bind_param('ii',$quantity,$id);
              $stmt->execute();
            }
          }
          else{
            if($order_status != 'delivered'){
              $stmt = $conn->prepare("UPDATE products SET stock_quantity=stock_quantity+? WHERE id=?");
              $stmt->bind_param('ii',$quantity,$id);
              $stmt->execute();
            }
          }

          $stmt = $conn->prepare("UPDATE orders SET order_status=? WHERE id=?");
         $stmt->bind_param('si',$order_status,$id);

        if($stmt->execute()){
            ?>
            <script>
              window.location.href="order.php?order_updated=Order has been updated successfully"
            </script>
            <?php
        }else{
          ?>
            <script>
              window.location.href="order.php?order_failed=Error occured, try again"
            </script>
            <?php
        }


}else{

  header('location: order.php');
  exit;
}

?>

<div class="container-fluid">
  <div class="row"  style="min-height: 100%">
 
  <main class="col-md-9 ms-sm-auto col-lg-12 px-md-4">
      <div class="row">
           <div class="col-12">
               <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                   <h3 class="mb-sm-0">Edit Order</h3>

                   <div class="page-title-right menu">
                       <ol class="breadcrumb pt-5">
                           <li class="breadcrumb-item">Awesome Store</li>
                           <li class="breadcrumb-item active">Order</li>
                       </ol>
                   </div>
               </div>
           </div>
       </div>
      <div class="table-responsive">
      

          <div class="mx-auto container">
              <form id="edit-order-form"  method="POST" action="edit_order.php">

              <?php foreach($order as $r){?>

                <p style="color: red;"><?php if(isset($_GET['error'])){ echo $_GET['error']; }?></p>
                <div class="form-group my-3">
                    <label>Order Id</label>
                    <p class="my-4"><?php echo $r['id'];?></p>
                   
                </div>
                <div class="form-group my-3">
                    <label>Shoppe Order Id</label>
                    <p class="my-4"><?php echo $r['shoppe_order_id'];?></p>
                   
                </div>
                <div class="form-group my-3">
                    <label>Total Order Quantity</label>
                    <p class="my-4"><?php echo $r['order_quantity'];?></p>
                   
                </div>
                  <div class="form-group mt-3">
                        <label>OrderPrice</label>
                        <p class="my-4"><?php echo $r['total_price'];?></p>
                    
                  </div>


                  <input type="hidden" name="order_id" value="<?php echo $r['id'];?>"/>
         
                <div class="form-group my-3">
                    <label>Order Status</label>
                    <select  class="form-select" required name="order_status">
                        <option value="paid" <?php if($r['order_status']=='not paid'){ echo "selected";}?> >Paid</option>
                        <option value="shipped" <?php if($r['order_status']=='shipped'){ echo "selected";}?>>Shipped</option>
                        <option value="delivered" <?php if($r['order_status']=='delivered'){ echo "selected";}?>>Delivered</option>
                        <option value="cancel" <?php if($r['order_status']=='cancel'){ echo "selected";}?>>Cancel</option>
                    </select>
                </div>
                
                  <div class="form-group my-3">
                         <label>Order Date</label>
                    <p class="my-4"><?php echo $r['order_date'];?></p>

                    
                  </div>

                <div class="form-group mt-3">
                    <input type="submit" class="btn btn-primary" name="edit_order" value="Edit"/>
                </div>
 


                <?php } ?>

              </form>
          </div>
    




      </div>
    </main>
  </div>
</div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
  </body>
</html>