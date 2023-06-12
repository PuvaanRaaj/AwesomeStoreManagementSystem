<?php
include('config/db.php');

if(isset($_POST['product_id']) && isset($_POST['quantity'])){
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    $stmt = $conn->prepare("SELECT product_price FROM products WHERE id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();

    $result = $stmt->get_result();
    if($result->num_rows > 0){
        $product = $result->fetch_assoc();
        $total_price = $product['product_price'] * $quantity;
        echo $total_price;
    }
    else {
        echo 'Product not found';
    }
}
?>
