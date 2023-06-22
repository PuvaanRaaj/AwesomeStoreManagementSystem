<?php include('layouts/header.php'); ?>

<?php
if (!isset($_SESSION['admin_logged_in'])) {
?>
  <script>
    window.location.href = "login.php";
  </script>
<?php
  exit();
}
?>
<?php
//1. Determine page number
if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
  // If the user has already entered a page, use the selected page number
  $page_no = $_GET['page_no'];
} else {
  // If the user just entered the page, set the default page as 1
  $page_no = 1;
}

//2. Get total number of orders
$stmt1 = $conn->prepare("SELECT COUNT(*) As total_records FROM orders");
$stmt1->execute();
$stmt1->bind_result($total_records);
$stmt1->store_result();
$stmt1->fetch();

//3. Orders per page
$total_records_per_page = 5;
$offset = ($page_no - 1) * $total_records_per_page;

$previous_page = $page_no - 1;
$next_page = $page_no + 1;

$adjacents = "2";
$total_no_of_pages = ceil($total_records / $total_records_per_page);

//4. Get orders for the current page
$stmt2 = $conn->prepare("SELECT * FROM orders LIMIT $offset,$total_records_per_page");
$stmt2->execute();
$orders = $stmt2->get_result();
?>

<div class="container-fluid">
  <div class="row" style="min-height: 100%">

    <main class="col-md-9 ms-sm-auto col-lg-12 px-md-4">
      <div class="row">
        <div class="col-12">
          <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h3 class="mb-sm-0 pt-5">Dashboard</h3>
            <div class="page-title-right menu">
              <ol class="breadcrumb pt-5">
                <li class="breadcrumb-item">Awesome Store</li>
                <li class="breadcrumb-item active">HomePage</li>
              </ol>
            </div>
          </div>
          <hr>
        </div>
      </div>

<!-- Admin Dashboard Overview -->
<div class="row align-items-center mb-3">
  <div class="col-md-6 col-lg-3">
    <div class="card bg-primary text-white">
      <div class="card-body">
        <h5 class="card-title">Total Sales</h5>
        <?php
        $stmt3 = $conn->prepare("SELECT SUM(total_price) AS total_sales FROM orders");
        $stmt3->execute();
        $stmt3->bind_result($total_sales);
        $stmt3->store_result();
        $stmt3->fetch();
        ?>
        <p class="card-text">RM <?php echo htmlspecialchars($total_sales, ENT_QUOTES, 'UTF-8'); ?></p>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-lg-3">
    <div class="card bg-success text-white">
      <div class="card-body">
        <h5 class="card-title">Total Orders</h5>
        <?php
        $stmt4 = $conn->prepare("SELECT COUNT(*) AS total_orders FROM orders");
        $stmt4->execute();
        $stmt4->bind_result($total_orders);
        $stmt4->store_result();
        $stmt4->fetch();
        ?>
        <p class="card-text"><?php echo htmlspecialchars($total_orders, ENT_QUOTES, 'UTF-8'); ?></p>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-lg-3">
    <div class="card bg-info text-white">
      <div class="card-body">
        <h5 class="card-title">Total Product</h5>
        <?php
        $stmt5 = $conn->prepare("SELECT COUNT(*) AS total_products FROM products");
        $stmt5->execute();
        $stmt5->bind_result($total_products);
        $stmt5->store_result();
        $stmt5->fetch();
        ?>
        <p class="card-text"><?php echo htmlspecialchars($total_products, ENT_QUOTES, 'UTF-8'); ?></p>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-lg-3">
    <div class="card bg-warning text-dark">
      <div class="card-body">
        <h5 class="card-title">Total Staff</h5>
        <?php
        $stmt6 = $conn->prepare("SELECT COUNT(*) AS total_staff FROM staffs");
        $stmt6->execute();
        $stmt6->bind_result($total_staff);
        $stmt6->store_result();
        $stmt6->fetch();
        ?>
        <p class="card-text"><?php echo htmlspecialchars($total_staff, ENT_QUOTES, 'UTF-8'); ?></p>
      </div>
    </div>
  </div>
</div>

      <!-- End of Admin Dashboard Overview -->

      <!-- Carousel Theme was took from Bootstrap and the Images were added by Puvaan Raaj -->
      <div class="product-carousel">
        <div id="carouselExampleIndicators" class="carousel carousel-dark slide" data-bs-ride="true">
          <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4" aria-label="Slide 5"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="5" aria-label="Slide 6"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="6" aria-label="Slide 7"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="7" aria-label="Slide 8"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="8" aria-label="Slide 9"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="9" aria-label="Slide 10"></button>
          </div>
   
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <p>First Book</p>
                  <img src="images/dashboardpic/Book1.png" class="d-block mx-auto w-20 h-100 " alt="...">
                </div>
                <div class="carousel-item">
                <p>Second Book</p>
                  <img src="images/dashboardpic/Book2.png" class="d-block mx-auto w-20 h-100 " alt="...">
                </div>
                <div class="carousel-item">
                <p>Third Book</p>
                  <img src="images/dashboardpic/Book3.png" class="d-block mx-auto w-20 h-100 " alt="...">
                </div>
                <div class="carousel-item">
                <p>Fourth Book</p>
                  <img src="images/dashboardpic/Book4.png" class="d-block mx-auto w-20 h-100 " alt="...">
                </div>
                <div class="carousel-item">
                <p>Fifth Book</p>
                  <img src="images/dashboardpic/Book5.png" class="d-block mx-auto w-20 h-100 " alt="...">
                </div>
                <div class="carousel-item">
                <p>Sixth Book</p>
                  <img src="images/dashboardpic/Book6.png" class="d-block mx-auto w-20 h-100 " alt="...">
                </div>
                <div class="carousel-item">
                <p>Seventh Book</p>
                  <img src="images/dashboardpic/Book7.png" class="d-block mx-auto w-20 h-100 " alt="...">
                </div>
                <div class="carousel-item">
                <p>Eight Book</p>
                  <img src="images/dashboardpic/Book8.png" class="d-block mx-auto w-20 h-100 " alt="...">
                </div>
                <div class="carousel-item">
                <p>Ninth Book</p>
                  <img src="images/dashboardpic/Book9.png" class="d-block mx-auto w-20 h-100 " alt="...">
                </div>
                <div class="carousel-item">
                <p>Tenth Book</p>
                  <img src="images/dashboardpic/Book10.png" class="d-block mx-auto w-20 h-100 " alt="...">
                </div>
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
          </div>
        </div>
        <br>

      <br>

      <h2>Orders</h2>
      <hr>

      <div class="table-responsive">
        <table class="table table-striped table-sm table-bordered">
          <thead>
            <tr>
              <th scope="col" style="text-align: center; vertical-align: middle;">Order Id</th>
              <th scope="col" style="text-align: center; vertical-align: middle;">Shoppe Order Id</th>
              <th scope="col" style="text-align: center; vertical-align: middle;">Order Status</th>
              <th scope="col" style="text-align: center; vertical-align: middle;">Customer name</th>
              <th scope="col" style="text-align: center; vertical-align: middle;">Order Quantity</th>
              <th scope="col" style="text-align: center; vertical-align: middle;">Order Date</th>
              <th scope="col" style="text-align: center; vertical-align: middle;">Sub Total</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($orders as $order) { ?>
              <tr>
                <td style="text-align: center;"><?php echo htmlspecialchars($order['id'], ENT_QUOTES, 'UTF-8'); ?></td>
                <td style="text-align: center;"><?php echo htmlspecialchars($order['shoppe_order_id'], ENT_QUOTES, 'UTF-8'); ?></td>
                <td style="text-align: center;"><?php echo htmlspecialchars($order['order_status'], ENT_QUOTES, 'UTF-8'); ?></td>
                <td style="text-align: center;"><?php echo htmlspecialchars($order['customer_name'], ENT_QUOTES, 'UTF-8'); ?></td>
                <td style="text-align: center;"><?php echo htmlspecialchars($order['order_quantity'], ENT_QUOTES, 'UTF-8'); ?></td>
                <td style="text-align: center;"><?php echo htmlspecialchars($order['order_date'], ENT_QUOTES, 'UTF-8'); ?></td>
                <td style="text-align: center;"><?php echo htmlspecialchars($order['total_payment'], ENT_QUOTES, 'UTF-8'); ?></td>
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
<script src="dashboard.js"></script>
</body>

</html>
