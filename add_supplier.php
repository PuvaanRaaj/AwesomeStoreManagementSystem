<?php include('layouts/header.php'); ?>

<div class="container-fluid">
  <div class="row"  style="min-height: 100%">
 
  <main class="col-md-9 ms-sm-auto col-lg-12 px-md-4">
      <div class="row">
           <div class="col-12">
               <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                   <h3 class="mb-sm-0 pt-5">Create Supplier</h3>

                   <div class="page-title-right menu">
                       <ol class="breadcrumb pt-5">
                           <li class="breadcrumb-item">Awesome Store</li>
                           <li class="breadcrumb-item active">Supplier</li>
                       </ol>
                   </div>
               </div>

           </div>
       </div>
      <div class="table-responsive">

            <div class="mx-auto container">
                <form id="create-form"  method="POST" action="create_supplier.php" novalidate>
                    <p style="color: red;"><?php if(isset($_GET['error'])){ echo $_GET['error']; }?></p>
                    <div class="form-group mt-2">
                        <label>Supplier Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Insert Supplier Name" required/>
                    </div>
                    <div class="form-group mt-2">
                        <label>Supplier Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Insert Supplier Email" required/>
                    </div>
                    <div class="form-group mt-2">
                        <label>Supplier Address</label>
                        <input type="text" class="form-control" name="address" placeholder="Insert Supplier Address" required/>
                    </div>
                    <div class="form-group mt-2">
                        <label>Supplier Phone Number</label>
                        <input type="tel" class="form-control" name="number" placeholder="Insert Supplier Number" required/>
                    </div>
                    <div class="form-group mt-2">
                        <label>Supplier Shop</label>
                        <input type="text" class="form-control" name="shop" placeholder="Insert Supplier Shop or Organization Name" required/>
                    </div>
                    <div class="form-group mt-3">
                        <input type="submit" class="btn btn-primary" name="create_supplier" value="Create"/>
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
    var supplierName = document.querySelector('[name="name"]');
    var supplierEmail = document.querySelector('[name="email"]');
    var supplierAddress = document.querySelector('[name="address"]');
    var supplierNumber = document.querySelector('[name="number"]');
    var supplierShop = document.querySelector('[name="shop"]');

    var namePattern = /^[a-zA-Z0-9 ]*$/;
    var emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
    var numberPattern = /^(\+?\d{1,4}?\s?\d{1,3}?\s?\d{1,4})$/;

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
});
</script>




        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
  </body>
</html>
