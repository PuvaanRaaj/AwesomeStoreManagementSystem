<?php

include('config/db.php');

if(isset($_POST['create_product'])){
    
    // Validate product name
    $product_name = trim($_POST['name']);
    if (!preg_match("/^[A-Za-z0-9\s\-_]+$/", $product_name)) {
        echo "<script>window.location.href='create_product.php?error=Invalid product name'</script>";
        exit();
    }
    
    // Validate stock quantity, stock limit, and unit price
    $stock_quantity = $_POST['quantity'];
    $stock_limit = $_POST['limit'];
    $unit_price = $_POST['price'];
    if (!is_numeric($stock_quantity) || !is_numeric($stock_limit) || !is_numeric($unit_price) ||
        $stock_quantity < 0 || $stock_limit < 0 || $unit_price < 0) {
        echo "<script>window.location.href='create_product.php?error=Quantity, limit and price must be numeric and non-negative'</script>";
        exit();
    }

    // Validate supplier id
    $supplier_id = $_POST['supplier_id'];
    if ($supplier_id === '' || !is_numeric($supplier_id) || $supplier_id <= 0) {
        echo "<script>window.location.href='create_product.php?error=Supplier ID is required and must be a positive integer'</script>";
        exit();
    }

    // Validate image file
    $product_image_name = $_FILES['image1']['name'];
    $product_image = $_FILES['image1']['tmp_name'];
    $allowed_extensions = array("jpg", "jpeg", "png");
    $image_extension = pathinfo($product_image_name, PATHINFO_EXTENSION);
    if (!in_array($image_extension, $allowed_extensions)) {
        echo "<script>window.location.href='create_product.php?error=Invalid image format'</script>";
        exit();
    }

    $image_name1 = $product_name."1".$product_image_name;

    //upload images
    move_uploaded_file($product_image,"assets/product-images/".$image_name1);
 

    //create a new user
    $stmt = $conn->prepare("INSERT INTO products (product_name,stock_quantity,stock_limit,product_price,supplier_id,product_image)
                                                VALUES (?,?,?,?,?,?)");

    $stmt->bind_param('siiiis',$product_name,$stock_quantity,$stock_limit,$unit_price,$supplier_id,$image_name1);

    if($stmt->execute()){
        ?>
        <script>
        window.location.href="products.php?success=Product has been created successfully"
      </script>
        <?php
    }else{
        ?>
        <script>
        window.location.href="products.php?error=Error occurred, try again"
      </script>
        <?php
        
    }
}
?>
