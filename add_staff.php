<?php include('layouts/header.php')?>

<div class="container-fluid">
  <div class="row" style="min-height: 100%">
    <main class="col-md-12 ms-sm-auto col-lg-12 px-md-4">
      <div class="row">
        <div class="col-12">
          <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h3 class="mb-sm-0 pt-3">Staff</h3>
            <div class="page-title-right menu">
              <ol class="breadcrumb  pt-5">
                <li class="breadcrumb-item">Awesome Store</li>
                <li class="breadcrumb-item active">Add New Staff</li>
              </ol>
            </div>
          </div>
        </div>
      </div>

      <p class="text-center"></p>
      <div class="table-responsive">
        <div class="mx-auto container">
          <?php if (isset($_GET['error'])): ?>
            <p style="color: red;"><?php echo $_GET['error']; ?></p>
          <?php endif; ?>
          <form id="create-form" enctype="multipart/form-data" method="POST" action="create_staff.php">
            <div class="form-group mt-2">
              <label>Staff Name</label>
              <input type="text" class="form-control" name="name" placeholder="Please Enter Staff Name" required/>
            </div>
            <div class="form-group mt-2">
              <label>Staff Age</label>
              <input type="text" class="form-control" name="age" placeholder="Please Enter Staff Age" required/>
            </div>
            <div class="form-group mt-2">
              <label>Staff Address</label>
              <input type="text" class="form-control" name="address" placeholder="Please Enter Staff Address" required/>
            </div>
            <div class="form-group mt-2">
              <label>Staff Email</label>
              <input type="email" class="form-control" name="email" placeholder="Please Enter Staff Email" required/>
            </div>
            <div class="form-group mt-2">
              <label>Staff Salary</label>
              <input type="text" class="form-control" name="salary" placeholder="Please Enter Staff Salary" required/>
            </div>
            <div class="form-group mt-2">
              <label>Staff Password</label>
              <input type="password" class="form-control" name="password" placeholder="Please Enter Staff Password" required/>
              <small id="passwordHelp" class="form-text text-muted">
                Password must be 8 to 32 characters long, contain at least 1 number, 1 uppercase letter, 1 lowercase letter, and 1 special character.
              </small>
            </div>


            <div class="form-group mt-3">
              <input type="submit" class="btn btn-primary" name="create_staff" value="Create"/>
            </div>
          </form>
        </div>
      </div>
    </main>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.getElementById('create-form').addEventListener('submit', function(event) {
    var staffName = document.querySelector('[name="name"]');
    var staffAge = document.querySelector('[name="age"]');
    var staffAddress = document.querySelector('[name="address"]');
    var staffEmail = document.querySelector('[name="email"]');
    var staffSalary = document.querySelector('[name="salary"]');
    var staffPassword = document.querySelector('[name="password"]');

    var namePattern = /^[a-zA-Z\s]*$/;
    var agePattern = /^(1[89]|[2-6]\d|70)$/;
    var addressPattern = /^[a-zA-Z0-9\s\.,-]*$/;
    var emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
    var salaryPattern = /^\d*\.?\d*$/;
    var passwordPattern = /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,32}$/;

    if (!staffName.value.match(namePattern)) {
        Swal.fire({
            icon: 'error',
            title: 'Invalid staff name. Only alphabets and spaces are allowed.'
        });
        event.preventDefault();
        return false;
    }

    if (!staffAge.value.match(agePattern)) {
        Swal.fire({
            icon: 'error',
            title: 'Invalid age. Age should be between 18 to 70.'
        });
        event.preventDefault();
        return false;
    }

    if (!staffAddress.value.match(addressPattern)) {
        Swal.fire({
            icon: 'error',
            title: 'Invalid address. Only alphanumeric characters and spaces are allowed.'
        });
        event.preventDefault();
        return false;
    }

    if (!staffEmail.value.match(emailPattern)) {
        Swal.fire({
            icon: 'error',
            title: 'Please enter a valid email.'
        });
        event.preventDefault();
        return false;
    }

    if (!staffSalary.value.match(salaryPattern)) {
        Swal.fire({
            icon: 'error',
            title: 'Invalid salary. Please enter a valid amount.'
        });
        event.preventDefault();
        return false;
    }

    if (!staffPassword.value.match(passwordPattern)) {
        Swal.fire({
            icon: 'error',
            title: 'Invalid password. Password must be 8 to 32 characters long, contain at least 1 number, 1 uppercase letter, 1 lowercase letter, and 1 special character.'
        });
        event.preventDefault();
        return false;
    }
});
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
</body>
</html>