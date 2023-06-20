<?php
include('config/db.php');

// Confirm the required POST data is available
if (isset($_POST['shoppe_order_id'], $_POST['order_status'], $_POST['product_id'], $_POST['customer_name'], $_POST['customer_email'], $_POST['customer_address'], $_POST['customer_number'], $_POST['order_quantity'], $_POST['total_price'], $_POST['total_payment'])) {

    // Prepare the SQL statement
    $stmt = $conn->prepare('INSERT INTO orders (shoppe_order_id, order_status, product_id, customer_name, customer_email, customer_address, customer_number, order_quantity, total_price, total_payment) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');

    // Execute the statement with the POST data
    $stmt->execute([
        $_POST['shoppe_order_id'],
        $_POST['order_status'],
        $_POST['product_id'],
        $_POST['customer_name'],
        $_POST['customer_email'],
        $_POST['customer_address'],
        $_POST['customer_number'],
        $_POST['order_quantity'],
        $_POST['total_price'],
        $_POST['total_payment']
    ]);

    // Redirect back to the form page with a success message
    ?>
    <script>
      window.location.href="order.php?order_created=Order created successfully."
    </script>
    <?php

} else {
    ?>
    <script>
      window.location.href="order.php?order_failed=Missing required order data."
    </script>
    <?php
    // Redirect back to the form page with an error message

}
?>
