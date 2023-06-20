<?php
session_start();

include('config/db.php');

if(!isset($_SESSION['admin_logged_in'])){
     header('location: login.php');
     exit();
}

if(isset($_GET['id'])){
   $id = $_GET['id']; // 
    $stmt = $conn->prepare("DELETE FROM suppliers WHERE id=?");
    $stmt->bind_param('i',$id);

    if($stmt->execute()){
        ?>
        <script>
        window.location.href="supplier.php?success=deleted_successfully=Supplier details has been deleted successfully"
      </script>
        <?php
      
    }else{
        ?>
        <script>
        window.location.href="supplier.php?deleted_failure=Could not delete supplier detail"
      </script>
        <?php 
    }
}
?>
