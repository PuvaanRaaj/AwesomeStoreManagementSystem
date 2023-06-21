<?php include('layouts/header.php'); ?>

<?php
if (!isset($_GET['id']) && !isset($_POST['edit'])) {
    header('Location: staff.php');
    exit;
}

if (isset($_GET['id'])) {
    $staff_id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM staffs WHERE id=?");
    $stmt->bind_param('i', $staff_id);
    $stmt->execute();

    $staffs = $stmt->get_result();
} else if (isset($_POST['edit'])) {
    $staff_id = $_POST['id'];
    $staff_name = $_POST['name'];
    $staff_age = $_POST['age'];
    $staff_email = $_POST['email'];
    $staff_address = $_POST['address'];
    $staff_salary = $_POST['salary'];


    // Input validation
    if (empty($staff_name) || empty($staff_age) || empty($staff_email) || empty($staff_address) || empty($staff_salary)) {
        ?>
        <script>
        window.location.href="add_staff.php?error=Please fill in all fields"
      </script>
        <?php
        exit();
    }

    $stmt = $conn->prepare("UPDATE staffs SET staff_name=?, staff_age=?, staff_email=?, staff_address=?, staff_salary=? WHERE id=?");
    $stmt->bind_param('sissdi', $staff_name, $staff_age, $staff_email, $staff_address, $staff_salary, $staff_id);

    if ($stmt->execute()) {
        ?>
        <script>
        window.location.href="staff.php?success=Staff details have been updated successfully"
      </script>
        <?php
        exit();
    } else {
        ?>
        <script>
        window.location.href="staff.php?edit_failure_message=Error occurred, please try again"
      </script>
        <?php
        exit();
    }
}
?>

<div class="container-fluid mt-3">
    <div class="row" style="min-height: 100%">
        <main class="col-md-12 ms-sm-auto col-lg-12 px-md-4">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h3 class="mb-sm-0">Staff</h3>
                        <div class="page-title-right menu">
                            <ol class="breadcrumb ">
                                <li class="breadcrumb-item">Awesome Store</li>
                                <li class="breadcrumb-item active">Edit Staff Information</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <div class="mx-auto container">
                    <form id="edit-form" method="POST" action="edit_staff.php">
                        <p style="color: red;"><?php if (isset($_GET['error'])) { echo $_GET['error']; } ?></p>
                        <?php foreach ($staffs as $staff) { ?>
                            <input type="hidden" name="id" value="<?php echo $staff['id']; ?>" />
                            <div class="form-group mt-2">
                                <label>Staff Name</label>
                                <input type="text" class="form-control" id="staff-name" value="<?php echo $staff['staff_name']; ?>" name="name" placeholder="Name" required/ readonly>
                            </div>
                            <div class="form-group mt-2">
                                <label>Staff Age</label>
                                <input type="text" class="form-control" id="staff-age" value="<?php echo $staff['staff_age']; ?>" name="age" placeholder="Age" required/>
                            </div>
                            <div class="form-group mt-2">
                                <label>Staff Email</label>
                                <input type="text" class="form-control" id="staff-email" value="<?php echo $staff['staff_email']; ?>" name="email" placeholder="Email" required/>
                            </div>
                            <div class="form-group mt-2">
                                <label>Staff Address</label>
                                <input type="text" class="form-control" id="staff-address" value="<?php echo $staff['staff_address']; ?>" name="address" placeholder="Address" required/>
                            </div>
                            <div class="form-group mt-2">
                                <label>Staff Salary</label>
                                <input type="text" class="form-control" id="staff-salary" value="<?php echo $staff['staff_salary']; ?>" name="salary" placeholder="Salary" required/>
                            </div>
                            <div class="form-group mt-3">
                                <input type="submit" class="btn btn-primary" name="edit" value="Edit"/>
                            </div>
                        <?php } ?>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.getElementById('edit-form').addEventListener('submit', function(event) {
        var staffName = document.getElementById('staff-name');
        var staffAge = document.getElementById('staff-age');
        var staffEmail = document.getElementById('staff-email');
        var staffAddress = document.getElementById('staff-address');
        var staffSalary = document.getElementById('staff-salary');
        var staffPassword = document.getElementById('staff-password');

        var namePattern = /^[A-Za-z0-9\s\-_]+$/;
        var agePattern = /^[0-9]+$/;
        var emailParts = staffEmail.value.split('@');
        if (emailParts.length !== 2 || emailParts[0].length === 0 || emailParts[1].length === 0 || emailParts[1].indexOf('.') === -1) {
            Swal.fire('Invalid email format');
            event.preventDefault();
        } 

        var addressPattern = /.+/;
        var salaryPattern = /^[0-9]+(\.[0-9]{1,2})?$/;
        var passwordPattern = /^[\w@-]{8,}$/; // At least 8 characters, allows alphanumeric, @, -, _

        if (!namePattern.test(staffName.value)) {
            Swal.fire('Invalid staff name');
            event.preventDefault();
        } else if (!agePattern.test(staffAge.value)) {
            Swal.fire('Invalid staff age');
            event.preventDefault();
        } else if (!emailPattern.test(staffEmail.value)) {
            Swal.fire('Invalid staff email');
            event.preventDefault();
        } else if (!addressPattern.test(staffAddress.value)) {
            Swal.fire('Invalid staff address');
            event.preventDefault();
        } else if (!salaryPattern.test(staffSalary.value)) {
            Swal.fire('Invalid staff salary');
            event.preventDefault();
        } else if (!passwordPattern.test(staffPassword.value)) {
            Swal.fire('Invalid staff password. It should be at least 8 characters long and can contain alphanumeric characters, @, -, _');
            event.preventDefault();
        }
    });
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>

</body>
</html>
