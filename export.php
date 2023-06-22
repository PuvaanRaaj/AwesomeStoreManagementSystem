<?php

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="orders.csv"');

$stmt4 = $conn->prepare("SELECT * FROM orders");
$stmt4->execute();
$orders = $stmt4->get_result();

$out = fopen('php://output', 'w');
fputcsv($out, array_keys($orders[0]));

foreach ($orders as $order) {
    fputcsv($out, $order);
}

fclose($out);
exit;

?>