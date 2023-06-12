<?php

include('config/db.php');


if(isset($_POST['create_supplier'])){


  //create a new supplier
  $stmt = $conn->prepare("INSERT INTO suppliers (supplier_name, supplier_email, supplier_address, 
                            supplier_number, supplier_shop_name) VALUES (?,?,?,?,?)");



   $stmt->bind_param('sssis',$supplier_name, $supplier_email, $supplier_address, $supplier_number, $supplier_shop_name);

   $supplier_name = $_POST['name'];
   $supplier_email= $_POST['email'];
   $supplier_address = $_POST['address'];
   $supplier_number = $_POST['number'];
   $supplier_shop_name= $_POST['shop'];

    if($stmt->execute()){
        header('location: supplier.php');
    }else{
        header('location: supplier.php');
    }


}


 ?>


