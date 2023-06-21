<?php

session_start();

include('config/db.php');

?>

<?php

   if(!isset($_SESSION['staff_logged_in'])){
         header('location: login.php');
         exit();

   }

   if(isset($_GET['id'])){
       $staff_id = $_GET['id'];
        $stmt = $conn->prepare("DELETE FROM staffs WHERE id=?");
        $stmt->bind_param('i',$staff_id);

        if($stmt->execute()){
            ?>
            <script>
            window.location.href="staff.php?success=Staff details has been deleted successfully"
          </script>
            <?php

        }else{
            ?>
            <script>
            window.location.href="staff.php?error=Could not delete staff detail"
          </script>
            <?php

        }

   }
?>
