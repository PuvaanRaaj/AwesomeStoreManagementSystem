<?php

include('config/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $staff_name = $_POST['name'];
    $staff_age = $_POST['age'];
    $staff_email = $_POST['email'];
    $staff_address = $_POST['address'];
    $staff_salary = $_POST['salary'];
    $staff_password = $_POST['password'];

    // Validate inputs
    if (empty($staff_name) || empty($staff_age) || empty($staff_email) || empty($staff_address) || empty($staff_salary) || empty($staff_password)) {
        header('location: staff.php?error=Please fill in all fields');
        exit();
    }

    // Hash the password
    $hashed_password = password_hash($staff_password, PASSWORD_DEFAULT);

    // Create a new staff
    $stmt = $conn->prepare("INSERT INTO staffs (staff_name, staff_age, staff_email, staff_address, staff_salary, staff_password) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('sissds', $staff_name, $staff_age, $staff_email, $staff_address, $staff_salary, $hashed_password);

    if ($stmt->execute()) {
        header('location: staff.php');
    } else {
        header('location: staff.php?error=Could not add staff');
    }

    $stmt->close();
    $conn->close();
}
?>
