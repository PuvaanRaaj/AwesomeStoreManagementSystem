<?php
include('config/db.php');

if(isset($_POST['create_order'])) {

    $shoppe_order_id = $_POST['shoppe_orderid'];
    $order_status = $_POST['status'];
    $product_id = $_POST['product_id'];
    $customer_name = $_POST['name'];
    $customer_email = $_POST['email'];
    $customer_address = $_POST['address'];
    $customer_number = $_POST['number'];
    $order_quantity = $_POST['quantity'];
    $total_price = $_POST['cost'];
    $total_payment = $_POST['payment'];
    $order_date = date('Y-m-d H:i:s');  // Get current date and time

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO orders (shoppe_order_id, order_status, product_id, customer_name, customer_email, customer_address, 
                            customer_number, order_quantity, order_date, total_price, total_payment) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Bind the parameters to the SQL query
    $stmt->bind_param('ssissiisdds', $shoppe_order_id, $order_status, $product_id, $customer_name, $customer_email, $customer_address, 
                      $customer_number, $order_quantity, $order_date, $total_price, $total_payment);

    // Execute the SQL query
    if($stmt->execute()){
        header('location: order.php?product_created=Order has been created successfully');
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
