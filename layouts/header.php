<?php session_start(); ?>

<?php include('config/db.php'); ?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Awesome Store</title>

    <!-- CSS -->
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">

    <!-- Favicons -->
    
    <!-- DataTables -->
  	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">

    <!-- Bootstrap Scripts -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>

      <!-- JavaScript -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
      <link rel="stylesheet" href=" https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.min.js">
     
    <!-- Ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js">
    </script>



      <!-- Font Awesome -->
      <script defer src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/all.js"></script>

      <style>
        body {
            font-family: Arial, sans-serif;
        }
        .order-details {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .order-details p {
            line-height: 1.6;
        }
    </style>


  </head>
  <body>



<section class="header" id="title">

      <div class="container-fluid">
       <!-- Nav Bar -->
       <nav class="navbar navbar-expand-lg fixed-top bg-dark">  
         <a class="navbar-brand" href=""><img alt="Brand" class="store-image" src="images/photo_2022-12-18 11.09.54.jpeg">Awesome Store</a>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
           <span class="navbar-toggler-icon"></span>
         </button>
        

         <div class="nav-content collapse navbar-collapse " id="navbarSupportedContent">
            <ul class="navbar-nav  ms-auto">
             <li class="nav-item">
               <button class="btn header-item waves-effect button" type="button"  href="index.php">
                <a class="item" href="index.php">Home</a>
               </button>
             </li>
             <li class="nav-item d-xl-inline-block ms-1">
               <div class="dropdown">
                <button class="btn header-item waves-effect dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <a class="item" href="products.php">Product</a>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="products.php">View All Product</a></li>
                    <li><a class="dropdown-item" href="add_product.php">Add Product</a></li>
                  </ul>
                </div>
             </li>
             <li class="nav-item  d-xl-inline-block ms-1">
               <div class="dropdown">
                  <button class="btn header-item waves-effect dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <a class="item" href="order.php">Order</a>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="order.php">View Order</a></li>
                    <li><a class="dropdown-item" href="add_order.php">Add Order</a></li>
                  </ul>
                </div>
             </li>
             <li class="nav-item d-xl-inline-block ms-1">
               <div class="dropdown">
                  <button class="btn header-item waves-effect dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <a class="item" href="supplier.php">Supplier</a>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="supplier.php">View Supplier</a></li>
                    <li><a class="dropdown-item" href="add_supplier.php">Add Supplier</a></li>
                  </ul>
                </div>
             </li>
             <li class="nav-item d-xl-inline-block ms-1">
               <div class="dropdown">
                  <button class="btn header-item waves-effect dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <a class="item" href="staff.php">Staff</a>
                  </button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="staff.php">View Staff</a></li>
                    <li><a class="dropdown-item" href="add_staff.php">Add Staff</a></li>
                  </ul>
                </div>
             </li>
             <li class="nav-item d-xl-inline-block ms-1 mx-5">
               <div class="dropdown">
                  <button type="button" class="btn header-item waves-effect dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <a class="item">
                    <i class="fa-solid fa-user"></i>
                      <?php echo htmlspecialchars($_SESSION["admin_name"]); ?></a>
                  </button>
                  <div class="dropdown-menu">
                      <a class="dropdown-item" href="profile.php"><i class="ri-user-line align-middle me-1"></i>Profile</a>
                      <a class="dropdown-item" href="contact_dev.php" class="btn btn-warning">Help</a>
                      <a class="dropdown-item" href="resetpassword.php" class="btn btn-warning">Reset Your Password</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item text-danger" href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
                  </div>

                </div>
            </li>
            </ul>
         </div>
       </nav>
     </div>
</section>
