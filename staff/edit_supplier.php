<?php include('layouts/header.php'); ?>

<?php

function cleanInput($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $stmt = $conn->prepare("SELECT * FROM suppliers WHERE id=?");
  $stmt->bind_param('i', $id);
  $stmt->execute();

  $suppliers = $stmt->get_result();
} else if (isset($_POST['edit'])) {

  $id = $_POST['id'];
  $supplier_name = $_POST['name'];
  $supplier_email = $_POST['email'];
  $supplier_address = $_POST['address'];
  $supplier_number = $_POST['number'];
  $supplier_shop_name = $_POST['shop'];

  // Input validation
  if (empty($supplier_name) || empty($supplier_address) || empty($supplier_shop_name)) {
    echo "Name, Address, and Shop Name must not be empty.";
    exit;
  }

  if (!filter_var($supplier_email, FILTER_VALIDATE_EMAIL)) {
    // Handle invalid email
    header('Location: supplier.php?error=Invalid Email');
    exit();
  }

  $addressPattern = '/^[a-zA-Z0-9 .,]*$/';
  if (!preg_match($addressPattern, $supplier_address)) {
    // Handle invalid address
    header('Location: supplier.php?error=Invalid Address');
    exit();
  }

  // Continue with the update if validation passed
  $stmt = $conn->prepare("UPDATE suppliers SET supplier_name=?, supplier_email=?, supplier_address=?, supplier_number=?, supplier_shop_name=? WHERE id=?");
  $stmt->bind_param('sssisi', $supplier_name, $supplier_email, $supplier_address, $supplier_number, $supplier_shop_name, $id);

  if ($stmt->execute()) {
?>
    <script>
      window.location.href = "supplier.php?success=Supplier updated successfully."
    </script>
  <?php
  } else {
  ?>
    <script>
      window.location.href = "supplier.php?error=Failed to update supplier."
    </script>
  <?php
  }
} else {
  ?>
  <script>
    window.location.href = "supplier.php"
  </script>
<?php
  exit;
}

?>


<div class="container-fluid mt-3">
  <div class="row" style="min-height: 100%">
    <main class="col-md-12 ms-sm-auto col-lg-12 px-md-4">
      <div class="row">
        <div class="col-12">
          <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h3 class="mb-sm-0">Supplier</h3>
            <div class="page-title-right menu">
              <ol class="breadcrumb ">
                <li class="breadcrumb-item">Awesome Store</li>
                <li class="breadcrumb-item active">Edit Supplier Information</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="table-responsive">
        <div class="mx-auto container">
          <form id="edit-form" method="POST" action="edit_supplier.php">
            <p style="color: red;"><?php if (isset($_GET['error'])) {
                                      echo $_GET['error'];
                                    } ?></p>
            <div class="form-group mt-2">
              <?php foreach ($suppliers as $supplier) { ?>
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($supplier['id']); ?>" />

                <label>Supplier Name</label>
                <input type="text" class="form-control" value="<?php echo htmlspecialchars($supplier['supplier_name']) ?>" name="name" placeholder="Supplier Name" required />
            </div>

            <div class="form-group mt-2">
              <label>Supplier Email</label>
              <input type="email" class="form-control" value="<?php echo htmlspecialchars($supplier['supplier_email']) ?>" name="email" placeholder="Supplier Email" required />
            </div>
            <div class="form-group mt-2">
              <label>Supplier Address</label>
              <input type="text" class="form-control" value="<?php echo htmlspecialchars($supplier['supplier_address']) ?>" name="address" placeholder="Supplier Address" required />
            </div>
            <div class="form-group mt-2">
              <label>Supplier Number</label>
              <input type="tel" class="form-control" value="<?php echo htmlspecialchars($supplier['supplier_number']) ?>" name="number" placeholder="Supplier Phone Number" required />
            </div>
            <div class="form-group mt-2">
              <label>Supplier Shop Name</label>
              <input type="text" class="form-control" value="<?php echo htmlspecialchars($supplier['supplier_shop_name']) ?>" name="shop" placeholder="Supplier Shop Name" required />
            </div>
            <div class="form-group mt-3">
              <input type="submit" class="btn btn-primary" name="edit" value="Edit" />
            </div>
          <?php } ?>
          </form>
        </div>
      </div>
    </main>
  </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
  document.getElementById('edit-form').addEventListener('submit', function(event) {
    var supplierName = document.querySelector('[name="name"]');
    var supplierEmail = document.querySelector('[name="email"]');
    var supplierAddress = document.querySelector('[name="address"]');
    var supplierNumber = document.querySelector('[name="number"]');
    var supplierShop = document.querySelector('[name="shop"]');

    var namePattern = /^[a-zA-Z0-9 ]*$/;
    var emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
    var numberPattern = /^(\+?\d{1,4}?\s?\d{1,3}?\s?\d{1,4})$/;
    var addressPattern = /^[a-zA-Z0-9 .,]*$/;

    if (!supplierName.value.match(namePattern)) {
      Swal.fire({
        icon: 'error',
        title: 'Invalid supplier name. Special characters are not allowed.'
      });
      event.preventDefault();
      return false;
    }

    if (!supplierShop.value.match(namePattern)) {
      Swal.fire({
        icon: 'error',
        title: 'Invalid supplier shop name. Special characters are not allowed.'
      });
      event.preventDefault();
      return false;
    }

    if (!supplierEmail.value.match(emailPattern)) {
      Swal.fire({
        icon: 'error',
        title: 'Please enter a valid email.'
      });
      event.preventDefault();
      return false;
    }

    if (!supplierNumber.value.match(numberPattern)) {
      Swal.fire({
        icon: 'error',
        title: 'Invalid phone number. Must be a valid number format.'
      });
      event.preventDefault();
      return false;
    }

    if (!supplierAddress.value.match(addressPattern)) {
      Swal.fire({
        icon: 'error',
        title: 'Invalid address. Only alphabets, numbers, spaces, comma, and period are allowed.'
      });
      event.preventDefault();
      return false;
    }
  });
</script>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>

</body>

</html>
