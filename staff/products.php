<?php include('layouts/header.php'); ?>

<?php

if (!isset($_SESSION['admin_logged_in'])) {
?>
  <script>
    window.location.href = "login.php"
  </script>
<?php
  exit();
}

?>

<?php

//1. determine page no
if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
  //if user has already entered page then page number is the one that they selected
  $page_no = $_GET['page_no'];
} else {
  //if user just entered the page then default page is 1
  $page_no = 1;
}

//2. return number of products
$stmt1 = $conn->prepare("SELECT COUNT(*) As total_records FROM products");
$stmt1->execute();
$stmt1->bind_result($total_records);
$stmt1->store_result();
$stmt1->fetch();


//3. products per page
$total_records_per_page = 5;
$offset = ($page_no - 1) * $total_records_per_page;
$previous_page = $page_no - 1;
$next_page = $page_no + 1;
$adjacents = "2";
$total_no_of_pages = ceil($total_records / $total_records_per_page);



//4. get all products
$stmt2 = $conn->prepare("SELECT * FROM products ORDER BY (stock_quantity < stock_limit) DESC, created_at DESC LIMIT $offset,$total_records_per_page");
$stmt2->execute();
$products = $stmt2->get_result();

?>



<div class="container-fluid">
  <div class="row" style="min-height: 100%">



    <main class="col-md-12 ms-sm-auto col-lg-12 px-md-4">
      <div class="row">
        <div class="col-12">
          <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h3 class="mb-sm-0 pt-3">Products</h3>
            <div class="page-title-right menu">
              <ol class="breadcrumb  pt-5">
                <li class="breadcrumb-item">Awesome Store</li>
                <li class="breadcrumb-item active">Product Lists</li>
              </ol>
            </div>
          </div>

        </div>
      </div>
      

      <div class="table-responsive">
      <table class="table table-striped table-sm table-bordered">
          <thead>
            <tr>
              <th scope="col" style="text-align: center;">Product Id</th>
              <th scope="col" style="text-align: center;">Product Image</th>
              <th scope="col" style="text-align: center;">Product Name</th>
              <th scope="col" style="text-align: center;">Supplier ID</th>
              <th scope="col" style="text-align: center;">Product Price</th>
              <th scope="col" style="text-align: center;">Available Stock Quantity</th>
              <th scope="col" style="text-align: center;">Product Stock Limit</th>
              <th scope="col" style="text-align: center; vertical-align: middle;">Created Date</th>


              <th scope="col" style="text-align: center;vertical-align: middle;">Edit Images</th>
              <th scope="col" style="text-align: center;vertical-align: middle;">Edit</th>
              <th scope="col" style="text-align: center; vertical-align: middle;">Delete</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($products as $product) { ?>
              <tr <?php echo ($product['stock_quantity'] < $product['stock_limit']) ? 'style="background-color: #FFE5CA;"' : ''; ?>>
                <td style="text-align: center;"><?php echo htmlspecialchars($product['id']); ?></td>
                <td style="text-align: center;"><img src="<?php echo "assets/product-images/" . $product['product_image']; ?>" style="width: 70px; height:70px" /></td>
                <td style="text-align: center;"><?php echo htmlspecialchars($product['product_name']); ?></td>
                <td style="text-align: center;"><?php echo htmlspecialchars($product['supplier_id']); ?></td>
                <td style="text-align: center;"><?php echo htmlspecialchars($product['product_price']); ?></td>
                <td style="text-align: center;"><?php echo htmlspecialchars($product['stock_quantity']); ?></td>
                <td style="text-align: center;"><?php echo htmlspecialchars($product['stock_limit']); ?></td>
                <td style="text-align: center;"><?php echo htmlspecialchars($product['created_at']); ?></td>

                <td><a class="btn btn-warning" href="<?php echo "edit_images.php?id=" . $product['id'] . "&product_name=" . $product['product_name']; ?>">Edit Images</a></td>
                <td><a class="btn btn-primary" href="edit_product.php?id=<?php echo $product['id']; ?>"><i class="fas fa-edit"></i>Edit</a></td>
                <td><a class="btn btn-danger" href="delete_products.php?id=<?php echo $product['id']; ?>"><i class="fas fa-trash-alt"></i>Delete</a></td>

              </tr>
            <?php } ?>


          </tbody>
        </table>


        <nav aria-label="Page navigation example" class="mx-auto">
          <ul class="pagination mt-5 mx-auto">

            <li class="page-item <?php if ($page_no <= 1) {
                                    echo 'disabled';
                                  } ?> ">
              <a class="page-link" href="<?php if ($page_no <= 1) {
                                            echo '#';
                                          } else {
                                            echo "?page_no=" . ($page_no - 1);
                                          } ?>">Previous</a>
            </li>


            <li class="page-item"><a class="page-link" href="?page_no=1">1</a></li>
            <li class="page-item"><a class="page-link" href="?page_no=2">2</a></li>

            <?php if ($page_no >= 3) { ?>
              <li class="page-item"><a class="page-link" href="#">...</a></li>
              <li class="page-item"><a class="page-link" href="<?php echo "?page_no=" . $page_no; ?>"><?php echo $page_no; ?></a></li>
            <?php } ?>



            <li class="page-item <?php if ($page_no >=  $total_no_of_pages) {
                                    echo 'disabled';
                                  } ?>">
              <a class="page-link" href="<?php if ($page_no >= $total_no_of_pages) {
                                            echo '#';
                                          } else {
                                            echo "?page_no=" . ($page_no + 1);
                                          } ?>">Next</a>
            </li>
          </ul>
        </nav>











      </div>
    </main>
  </div>




</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
  <?php if (isset($_GET['error'])) : ?>
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: '<?php echo $_GET['error']; ?>'
    })
  <?php endif; ?>

  <?php if (isset($_GET['success'])) : ?>
    Swal.fire({
      icon: 'success',
      title: 'Success',
      text: '<?php echo $_GET['success']; ?>'
    })
  <?php endif; ?>
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>

</body>

</html>