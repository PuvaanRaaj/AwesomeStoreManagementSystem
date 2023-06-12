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
       $id = $_GET['id'];
        $stmt = $conn->prepare("DELETE FROM orders WHERE id=?");
        $stmt->bind_param('i',$id);

        if($stmt->execute()){

          header('location: order.php?deleted_successfully=Order has been deleted successfully');

        }else{
            header('location: order.php?deleted_failure=Could not delete product');
        }
   
   }

?>
