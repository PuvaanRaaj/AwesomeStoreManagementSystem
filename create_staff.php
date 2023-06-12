<?php

include('config/db.php');


if(isset($_POST['create_staff'])){

    // Hash the password
    $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
 
    //create a new staff
    $stmt = $conn->prepare("INSERT INTO staffs (staff_name, staff_age, staff_email, staff_address,staff_salary, staff_password)
                                                  VALUES (?,?,?,?,?,?)");

    $stmt->bind_param('sissds',$staff_name, $staff_age, $staff_email, $staff_address, $staff_salary, $staff_password);

    $staff_name = $_POST['name'];
    $staff_age = $_POST['age'];
    $staff_email = $_POST['email'];
    $staff_address = $_POST['address'];
    $staff_salary = $_POST['salary'];
    // Use the hashed password
    $staff_password = $hashed_password;
    
    if($stmt->execute()){

        header('location: staff.php');
    }else{
        header('location: staff.php');
    }

}

?>
