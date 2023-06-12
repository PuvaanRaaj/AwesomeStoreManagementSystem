<?php

session_start();

include('config/db.php');

?>

<?php

   if(!isset($_SESSION['admin_logged_in'])){
         header('location: login.php');
         exit();

   }

   if(isset($_GET['supplier_id'])){
       $supplier_id = $_GET['supplier_id'];
        $stmt = $conn->prepare("DELETE FROM suppliers WHERE supplier_id=?");
        $stmt->bind_param('i',$supplier_id);

        if($stmt->execute()){

          header('location: supplier.php?deleted_successfully=Staff details has been deleted successfully');

        }else{
            header('location: supplier.php?deleted_failure=Could not delete staff detail');
        }

   }
?>

