<?php

session_start();

include('config/db.php');

?>


<?php

if (!isset($_SESSION['staff_logged_in'])) {
  header('location: login.php');
  exit();
}


if (isset($_GET['id'])) {
  $product_id = $_GET['id'];
  $stmt = $conn->prepare("DELETE FROM products WHERE id=?");
  $stmt->bind_param('i', $product_id);

  if ($stmt->execute()) {
?>
    <script>
      window.location.href = "products.php?success=Product has been deleted successfully"
    </script>
  <?php
  } else {

  ?>
    <script>
      window.location.href = "products.php?error=Could not delete product"
    </script>
<?php
  }
}

?>