<?php
session_start();

include('config/db.php');

if(!isset($_SESSION['staff_logged_in'])){
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
        window.location.href="supplier.php?success=Supplier details has been deleted successfully"
      </script>
        <?php
      
    }else{
        ?>
        <script>
        window.location.href="supplier.php?error=Could not delete supplier detail"
      </script>
        <?php 
    }
}
?>
