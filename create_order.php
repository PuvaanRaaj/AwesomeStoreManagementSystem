<?php
include('config/db.php');

// Confirm the required POST data is available
if (isset($_POST['shoppe_order_id'], $_POST['order_status'], $_POST['product_id'], $_POST['customer_name'], $_POST['customer_email'], $_POST['customer_address'], $_POST['customer_number'], $_POST['order_quantity'], $_POST['total_price'], $_POST['total_payment'])) {

    // Sanitize and validate data
    $shoppe_order_id = filter_input(INPUT_POST, 'shoppe_order_id', FILTER_SANITIZE_SPECIAL_CHARS);
    $order_status = filter_input(INPUT_POST, 'order_status', FILTER_SANITIZE_SPECIAL_CHARS);
    $product_id = filter_input(INPUT_POST, 'product_id', FILTER_SANITIZE_NUMBER_INT);
    $customer_name = filter_input(INPUT_POST, 'customer_name', FILTER_SANITIZE_SPECIAL_CHARS);
    $customer_email = filter_input(INPUT_POST, 'customer_email', FILTER_SANITIZE_EMAIL);
    $customer_address = filter_input(INPUT_POST, 'customer_address', FILTER_SANITIZE_SPECIAL_CHARS);
    $customer_number = filter_input(INPUT_POST, 'customer_number', FILTER_SANITIZE_SPECIAL_CHARS);
    $order_quantity = filter_input(INPUT_POST, 'order_quantity', FILTER_SANITIZE_NUMBER_INT);
    $total_price = filter_input(INPUT_POST, 'total_price', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $total_payment = filter_input(INPUT_POST, 'total_payment', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    
    // Check email format
    if (!filter_var($customer_email, FILTER_VALIDATE_EMAIL)) {
        ?>
        <script>
          window.location.href="order.php?order_failed=Invalid email format."
        </script>
        <?php
        exit();
    }
    
    // Check numerical values
    if (!is_numeric($product_id) || !is_numeric($order_quantity) || !is_numeric($total_price) || !is_numeric($total_payment)) {
        ?>
        <script>
          window.location.href="order.php?order_failed=Invalid numerical values provided."
        </script>
        <?php
        exit();
    }

    // Validate customer name - allow only alphanumeric and spaces, disallow special characters
      if (!preg_match("/^[a-zA-Z0-9 ]*$/", $customer_name)) {
        ?>
        <script>
          window.location.href="order.php?order_failed=Invalid customer name. Special characters are not allowed."
        </script>
        <?php
        exit();
      }

      // Validate customer number - must start with 0
      if (substr($customer_number, 0, 1) !== '0') {
        ?>
        <script>
          window.location.href="order.php?order_failed=Invalid customer number. Must start with '0'."
        </script>
        <?php
        exit();
      }


    // Prepare the SQL statement
    $stmt = $conn->prepare('INSERT INTO orders (shoppe_order_id, order_status, product_id, customer_name, customer_email, customer_address, customer_number, order_quantity, total_price, total_payment) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');

    // Execute the statement with the POST data
    $stmt->execute([
        $shoppe_order_id,
        $order_status,
        $product_id,
        $customer_name,
        $customer_email,
        $customer_address,
        $customer_number,
        $order_quantity,
        $total_price,
        $total_payment
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
