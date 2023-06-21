<?php

include('config/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $staff_name = trim($_POST['name']);
    $staff_age = trim($_POST['age']);
    $staff_email = trim($_POST['email']);
    $staff_address = trim($_POST['address']);
    $staff_salary = trim($_POST['salary']);
    $staff_password = trim($_POST['password']);

    // Validate inputs
    if (empty($staff_name) || empty($staff_age) || empty($staff_email) || empty($staff_address) || empty($staff_salary) || empty($staff_password)) {
        header('location: staff.php?error=Please fill in all fields');
        exit();
    }

    if (!preg_match("/^[a-zA-Z-' ]*$/", $staff_name)) {
        header('location: staff.php?error=Only letters and white space allowed for name');
        exit();
    }

    if (!filter_var($staff_age, FILTER_VALIDATE_INT) || $staff_age < 18 || $staff_age > 65) {
        header('location: staff.php?error=Please enter a valid age');
        exit();
    }

    if (!filter_var($staff_email, FILTER_VALIDATE_EMAIL)) {
        header('location: staff.php?error=Invalid email format');
        exit();
    }

    if (!preg_match("/^[a-zA-Z0-9\s\.,-]*$/", $staff_address)) {
        header('location: staff.php?error=Invalid address format');
        exit();
    }

    if (!filter_var($staff_salary, FILTER_VALIDATE_FLOAT)) {
        header('location: staff.php?error=Invalid salary');
        exit();
    }

    // Hash the password
    $hashed_password = password_hash($staff_password, PASSWORD_DEFAULT);

    // Create a new staff
    $stmt = $conn->prepare("INSERT INTO staffs (staff_name, staff_age, staff_email, staff_address, staff_salary, staff_password) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('sissds', $staff_name, $staff_age, $staff_email, $staff_address, $staff_salary, $hashed_password);

    if ($stmt->execute()) {
        ?>
          <script>
          window.location.href="staff.php?success=Staff member created successfully."
        </script>
          <?php
    } else {
        ?>
          <script>
          window.location.href="staff.php?error=Failed to create staff member."
        </script>
          <?php
    }

    $stmt->close();
    $conn->close();
}
?>
