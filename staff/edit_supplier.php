<?php include('layouts/header.php'); ?>

<?php

   if(isset($_GET['id'])){
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM suppliers WHERE id=?");
    $stmt->bind_param('i',$id);
    $stmt->execute();

    $suppliers = $stmt->get_result(); 

  }else if(isset($_POST['edit'])){

       $id = $_POST['id'];
       $supplier_name= $_POST['name'];
       $supplier_email = $_POST['email'];
       $supplier_address= $_POST['address'];
       $supplier_number = $_POST['number'];
       $supplier_shop_name = $_POST['shop'];

       // Input validation
       if (empty($supplier_name) || empty($supplier_address) || empty($supplier_shop_name)) {
           echo "Name, Address and Shop Name must not be empty.";
           exit;
       }

       if (!filter_var($supplier_email, FILTER_VALIDATE_EMAIL)) {
           echo "Invalid email format.";
           exit;
       }

       if (!preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", $supplier_number)) {
           echo "Invalid phone number format. Expected format: 123-456-7890.";
           exit;
       }

       // Continue with the update if validation passed
        $stmt = $conn->prepare("UPDATE suppliers SET supplier_name=?, supplier_email=?, supplier_address=?, supplier_number=?, supplier_shop_name=? WHERE id=?");
        $stmt->bind_param('sssisi',$supplier_name, $supplier_email, $supplier_address, $supplier_number, $supplier_shop_name, $id);

        if($stmt->execute()){
            ?>
            <script>
              window.location.href="supplier.php"
            </script>
            <?php
        }else{
           ?>
          <script>
            window.location.href="supplier.php"
          </script>
          <?php
        }
  }else{
     header('location:supplier.php');
     exit;
   }

?>


<div class="container-fluid">
  <div class="row"  style="min-height: 100%">
    <main class="col-md-9 ms-sm-auto col-lg-12 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">

          </div>

        </div>
      </div>
      <h2>Edit Supplier Details</h2>
      <div class="table-responsive">



            <div class="mx-auto container">
              <form id="edit-form" method="POST" action="edit_supplier.php">
                  <p style="color: red;"><?php if(isset($_GET['error'])){ echo $_GET['error']; }?></p>
                  <div class="form-group mt-2">
                      <?php foreach($suppliers as $supplier){ ?>
                          <input type="hidden" name="id" value="<?php echo htmlspecialchars($supplier['id']);?>" />

                          <label>Supplier Name</label>
                          <input type="text" class="form-control" value="<?php echo htmlspecialchars($supplier['supplier_name'])?>" name="name" placeholder="Supplier Name" required/>
                      </div>
                      
                      <div class="form-group mt-2">
                          <label>Supplier Email</label>
                          <input type="email" class="form-control" value="<?php echo htmlspecialchars($supplier['supplier_email'])?>" name="email" placeholder="Supplier Email" required/>
                      </div>
                      <div class="form-group mt-2">
                          <label>Supplier Address</label>
                          <input type="text" class="form-control" value="<?php echo htmlspecialchars($supplier['supplier_address'])?>" name="address" placeholder="Supplier Address" required/>
                      </div>
                      <div class="form-group mt-2">
                          <label>Supplier Number</label>
                          <input type="tel" class="form-control" value="<?php echo htmlspecialchars($supplier['supplier_number'])?>" name="number" placeholder="Supplier Phone Number" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required/>
                      </div>
                      <div class="form-group mt-2">
                          <label>Supplier Shop Name</label>
                          <input type="text" class="form-control" value="<?php echo htmlspecialchars($supplier['supplier_shop_name'])?>" name="shop" placeholder="Supplier Shop Name" required/>
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



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
  </body>
</html>
