<?php

include('server/connection.php');

if(isset($_POST['update_images'])){

        $product_name = $_POST['product_name'];
        $product_id = $_POST['product_id'];

        $product_image_name =$_FILES['image1']['name'];
        $product_image =$_FILES['image1']['tmp_name'];


        $image_name1 = $product_name."1".$product_image_name;

        move_uploaded_file($product_image,"assets/product-images/".$image_name1);
       

        $stmt = $conn->prepare("UPDATE products SET product_image=? WHERE product_id=?");
        $stmt->bind_param('si',$image_name1,$product_id);



        if($stmt->execute()){
            header('location: products.php?images_updated=Images have been updated successfully');
        }else{
            header('location: products.php?images_failed=Error occured, try again');
        }
}

?>


