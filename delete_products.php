<?php 

session_start();
 
include('config/db.php');

?>


<?php 
   
   if(!isset($_SESSION['admin_logged_in'])){
         header('location: login.php');
         exit();

   }


   if(isset($_GET['id'])){
       $product_id = $_GET['id'];
        $stmt = $conn->prepare("DELETE FROM products WHERE id=?");
        $stmt->bind_param('i',$product_id);

        if($stmt->execute()){

          header('location: products.php?deleted_successfully=Product has been deleted successfully');

        }else{
            header('location: products.php?deleted_failure=Could not delete product');
        }
   
   }

?>