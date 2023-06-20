<?php
include('config/db.php');
if(isset($_GET['id'])){
    $orderId = (int)$_GET['id']; // cast to integer to prevent SQL injection
    // prepare SQL statement
    $stmt = $conn->prepare("SELECT * FROM orders WHERE id = ?");
    // bind the order id to the statement
    $stmt->bind_param("i", $orderId);
    // execute the statement
    $stmt->execute();
    // get the result
    $result = $stmt->get_result();
    // fetch the order
    $order = $result->fetch_assoc();

    if($order){
        echo "<div class='container mt-5'>";
        echo "<div class='card'>";
        echo "<div class='card-header'>Order Details</div>";
        echo "<div class='card-body'>";
        // echo the details as HTML
        echo "<p><strong>Order ID:</strong> ".htmlspecialchars($order['id'])."</p>";
        echo "<p><strong>Shoppe Order ID:</strong> ".htmlspecialchars($order['shoppe_order_id'])."</p>";
        echo "<p><strong>Order Status:</strong> ".htmlspecialchars($order['order_status'])."</p>";
        echo "<p><strong>Product ID:</strong> ".htmlspecialchars($order['product_id'])."</p>";
        echo "<p><strong>Customer Name:</strong> ".htmlspecialchars($order['customer_name'])."</p>";
        echo "<p><strong>Customer Email:</strong> ".htmlspecialchars($order['customer_email'])."</p>";
        echo "<p><strong>Customer Address:</strong> ".htmlspecialchars($order['customer_address'])."</p>";
        echo "<p><strong>Customer Phone Number:</strong> ".htmlspecialchars($order['customer_number'])."</p>";
        echo "<p><strong>Order Quantity:</strong> ".htmlspecialchars($order['order_quantity'])."</p>";
        echo "<p><strong>Order Date:</strong> ".htmlspecialchars($order['order_date'])."</p>";
        echo "<p><strong>Total Payment:</strong> ".htmlspecialchars($order['total_payment'])."</p>";
        echo "</div>"; // End of card body
        echo "</div>"; // End of card
        echo "</div>"; // End of container
    }else{
        echo "Order not found.";
    }
    
    
}
?>
