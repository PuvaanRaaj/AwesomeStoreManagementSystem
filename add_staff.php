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
          <form id="create-form" enctype="multipart/form-data" method="POST" action="add_staff.php">
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
</body>
</html>