<?php include('layouts/header.php'); ?>

<?php
    if(!isset($_SESSION['admin_logged_in'])){
      ?>
            <script>
              window.location.href="login.php"
            </script>
            <?php
          exit();
    }
?>
<?php
          //1. determine page no
          if(isset($_GET['page_no']) && $_GET['page_no'] != ""){
            //if user has already entered page then page number is the one that they selected
            $page_no = $_GET['page_no'];
          }else{
            //if user just entered the page then default page is 1
            $page_no = 1;
          }

          //2. return number of products
          $stmt1 = $conn->prepare("SELECT COUNT(*) As total_records FROM orders");
          $stmt1->execute();
          $stmt1->bind_result($total_records);
          $stmt1->store_result();
          $stmt1->fetch();


          //3. products per page
          $total_records_per_page = 5;

          $offset = ($page_no-1) * $total_records_per_page;

          $previous_page = $page_no - 1;
          $next_page = $page_no + 1;

          $adjacents = "2";

          $total_no_of_pages = ceil($total_records/$total_records_per_page);

          //4. get all products

          $stmt2 = $conn->prepare("SELECT * FROM orders LIMIT $offset,$total_records_per_page");
          $stmt2->execute();
          $orders = $stmt2->get_result();

?>


<div class="container-fluid">
  <div class="row"  style="min-height: 100%">
 
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




       <h2>Orders</h2>
       <hr>
      <?php if(isset($_GET['order_created'])){?>
           <p class="text-center" style="color: green;"><?php echo $_GET['order_created'];?></p>
        <?php } ?>

      <?php if(isset($_GET['order_updated'])){?>
           <p class="text-center" style="color: green;"><?php echo $_GET['order_updated'];?></p>
        <?php } ?>

        <?php if(isset($_GET['order_failed'])){?>
           <p class="text-center" style="color: red;"><?php echo $_GET['order_failed'];?></p>
        <?php } ?>




      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">Order Id</th>
              <th scope="col">Shoppe Order Id</th>
              <th scope="col">Order Status</th>
              <th scope="col">Customer name</th>
              <th scope="col">Order Quantity</th>
              <th scope="col">Order Date</th>
              <th scope="col">Sub Total</th>
            </tr>
          </thead>
          <tbody>

            <?php foreach($orders as $order){?>
            <tr>
              <td><?php echo $order['order_id'];?></td>
              <td><?php echo $order['shoppe_orderid'];?></td>
              <td><?php echo $order['order_status'];?></td>
              <td><?php echo $order['customer_name'];?></td>
              <td><?php echo $order['order_quantity'];?></td>
              <td><?php echo $order['order_date'];?></td>
              <td><?php echo $order['total_payment'];?></td>

            </tr>

            <?php }?>

          </tbody>
        </table>



        <nav aria-label="Page navigation example" class="mx-auto">
        <ul class="pagination mt-5 mx-auto">

          <li class="page-item <?php if($page_no<=1){echo 'disabled';}?> ">
               <a class="page-link" href="<?php if($page_no <= 1){echo '#';}else{ echo "?page_no=".($page_no-1);} ?>">Previous</a>
          </li>


          <li class="page-item"><a class="page-link" href="?page_no=1">1</a></li>
          <li class="page-item"><a class="page-link" href="?page_no=2">2</a></li>

          <?php if( $page_no >=3) {?>
            <li class="page-item"><a class="page-link" href="#">...</a></li>
            <li class="page-item"><a class="page-link" href="<?php echo "?page_no=".$page_no;?>"><?php echo $page_no;?></a></li>
          <?php } ?>



          <li class="page-item <?php if($page_no >=  $total_no_of_pages){echo 'disabled';}?>">
                 <a class="page-link" href="<?php if($page_no >= $total_no_of_pages ){echo '#';} else{ echo "?page_no=".($page_no+1);}?>">Next</a></li>
         </ul>
      </nav>

      </div>
    </main>
  </div>




</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
  </body>
</html>
