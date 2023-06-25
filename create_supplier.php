<?php

include('config/db.php');

function cleanInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if(isset($_POST['create_supplier'])){

   $supplier_name = cleanInput($_POST['name']);
   $supplier_email= cleanInput($_POST['email']);
   $supplier_address = cleanInput($_POST['address']);
   $supplier_number = cleanInput($_POST['number']);
   $supplier_shop_name= cleanInput($_POST['shop']);

   if (!filter_var($supplier_email, FILTER_VALIDATE_EMAIL)) {
      // Handle invalid email
      header('Location: supplier.php?error=Invalid Email');
      exit();
   }

  //create a new supplier
  $stmt = $conn->prepare("INSERT INTO suppliers (supplier_name, supplier_email, supplier_address, 
                            supplier_number, supplier_shop_name) VALUES (?,?,?,?,?)");

  $stmt->bind_param('sssis',$supplier_name, $supplier_email, $supplier_address, $supplier_number, $supplier_shop_name);

    if($stmt->execute()){
        ?>
        <script>
        window.location.href="supplier.php?success=supplier created successfully"
      </script>
        <?php
    }else{
        ?>
        <script>
        window.location.href="supplier.php?error=supplier cannot be created"
      </script>
        <?php
    }
}



 ?>
