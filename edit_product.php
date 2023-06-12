<?php

include('layouts/header.php');

   if(isset($_GET['product_id'])){
    $product_id = $_GET['product_id'];
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id=?");
    $stmt->bind_param('i',$product_id);
    $stmt->execute();

    $products = $stmt->get_result();

  }else if(isset($_POST['edit_btn'])){

    // Validate product name
    $product_name = trim($_POST['name']);
    if (!preg_match("/^[A-Za-z0-9\s\-_]+$/", $product_name)) {
        header('Location: edit_product.php?product_id='.$_POST['product_id'].'&error=Invalid product name');
        exit();
    }
    
    // Validate stock quantity and limit
    $stock_quantity = $_POST['stock'];
    $stock_limit = $_POST['limit'];
    if ($stock_quantity < 0 || $stock_limit < 0) {
        header('Location: edit_product.php?product_id='.$_POST['product_id'].'&error=Quantity and limit must be non-negative');
        exit();
    }

    // Validate unit price
    $unit_price = $_POST['price'];
    if ($unit_price < 0) {
        header('Location: edit_product.php?product_id='.$_POST['product_id'].'&error=Price must be non-negative');
        exit();
    }

    $product_id = $_POST['product_id'];

    $stmt = $conn->prepare("UPDATE products SET product_name=?, stock_quantity=?, stock_limit=?, unit_price=?
                                  WHERE product_id=?");
    $stmt->bind_param('siiii',$product_name,$stock_quantity,$stock_limit,$unit_price, $product_id);

    if($stmt->execute()){
      ?>
      <script>
        window.location.href="products.php?edit_success_message=Staff details has been updated successfully"
      </script>
      <?php
    }else{
      ?>
      <script>
        window.location.href="products.php?edit_failure_message=Error occurred, try again"
      </script>
      <?php
     }

  }else{
     header('location: products.php');
     exit;
   }


?>

<div class="container-fluid">
  <div class="row"  style="min-height: 100%">


    <main class="col-md-9 ms-sm-auto col-lg-12 px-md-4">
    <div class="row">
           <div class="col-12">
               <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                   <h3 class="mb-sm-0 ">Products</h3>

                   <div class="page-title-right menu">
                       <ol class="breadcrumb pt-5">
                           <li class="breadcrumb-item">Awesome Store</li>
                           <li class="breadcrumb-item active">Edit Product</li>
                       </ol>
                   </div>
               </div>

           </div>
       </div>

      <div class="table-responsive">


          <div class="mx-auto container">
            <form id="edit-form" method="POST" action="edit_product.php">
                <p style="color: red;">
                    <?php if(isset($_GET['error'])){ echo htmlspecialchars($_GET['error']); }?>
                </p>

                <?php foreach($products as $product){ ?>
                    <div class="form-group mt-2">
                        <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['product_id']);?>" />
                        <label>Product Name</label>
                        <input type="text" class="form-control" value="<?php echo htmlspecialchars($product['product_name']);?>" name="name" placeholder="Please enter the product name" required/>
                    </div>
                    <div class="form-group mt-2">
                        <label>Unit Price</label>
                        <input type="text" class="form-control" value="<?php echo htmlspecialchars($product['unit_price']);?>" name="price" placeholder="Please enter the product per unit price" required/>
                    </div>
                    <div class="form-group mt-2">
                        <label>Available Stock Quantity</label>
                        <input type="text" class="form-control" value="<?php echo htmlspecialchars($product['stock_quantity']);?>" name="stock" placeholder="Price" required/>
                    </div>
                    <div class="form-group mt-2">
                        <label>Product Stock Limit</label>
                        <input type="text" class="form-control" value="<?php echo htmlspecialchars($product['stock_limit']);?>" name="limit" placeholder="Color" required/>
                    </div>
                    <div class="form-group mt-3">
                        <input type="submit" class="btn btn-primary" name="edit_btn" value="Edit"/>
                    </div>
                <?php } ?>
            </form>
         </div>
      </div>
    </main>
  </div>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous">
    </script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
  </body>
</html>
