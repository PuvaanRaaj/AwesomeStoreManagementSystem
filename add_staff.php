<?php include('layouts/header.php')?>

<?php

    if(!isset($_SESSION['admin_logged_in'])){
          header('location: login.php');
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



          //2. return number of Staff
          $stmt1 = $conn->prepare("SELECT COUNT(*) As total_records FROM staffs");
          $stmt1->execute();
          $stmt1->bind_result($total_records);
          $stmt1->store_result();
          $stmt1->fetch();


          //3. staff per page
          $total_records_per_page = 5;
          $offset = ($page_no-1) * $total_records_per_page;
          $previous_page = $page_no - 1;
          $next_page = $page_no + 1;
          $adjacents = "2";
          $total_no_of_pages = ceil($total_records/$total_records_per_page);


          //4. get all Staff
          $stmt2 = $conn->prepare("SELECT * FROM staffs LIMIT $offset,$total_records_per_page");
          $stmt2->execute();
          $staffs = $stmt2->get_result();



?>

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

        <?php if(isset($_GET['edit_success_message'])){?>
           <p class="text-center" style="color: green;"><?php echo $_GET['edit_success_message'];?></p>
        <?php } ?>

        <?php if(isset($_GET['edit_failure_message'])){?>
           <p class="text-center" style="color: red;"><?php echo $_GET['edit_failure_message'];?></p>
        <?php } ?>

        <?php if(isset($_GET['deleted_successfully'])){?>
           <p class="text-center" style="color: green;"><?php echo $_GET['deleted_successfully'];?></p>
        <?php } ?>

        <?php if(isset($_GET['deleted_failure'])){?>
           <p class="text-center" style="color: red;"><?php echo $_GET['deleted_failure'];?></p>
        <?php } ?>

        <?php if(isset($_GET['staff_created'])){?>
           <p class="text-center" style="color: green;"><?php echo $_GET['staff_created'];?></p>
        <?php } ?>

        <?php if(isset($_GET['staff_failed'])){?>
           <p class="text-center" style="color: red;"><?php echo $_GET['staff_failed'];?></p>
        <?php } ?>


      <p class="text-center"></p>
      <div class="table-responsive">
          <div class="mx-auto container">
              <form id="create-form"  enctype="multipart/form-data" method="POST" action="create_staff.php">
                <p style="color: red;"><?php if(isset($_GET['error'])){ echo $_GET['error']; }?></p>
                <div class="form-group mt-2">
                    <label>Staff Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Please Enter Staff Name" required/>
                </div>
                  <div class="form-group mt-2">
                      <label>Staff Age</label>
                      <input type="text" class="form-control"  name="age" placeholder="Please Enter Staff Age" required/>
                  </div>
                  <div class="form-group mt-2">
                    <label>Staff Address</label>
                    <input type="text" class="form-control"  name="address" placeholder="Please Enter Staff Address" required/>
                </div>
                <div class="form-group mt-2">
                    <label>Staff Email</label>
                    <input type="text" class="form-control"  name="email" placeholder="Please Enter Staff Email" required/>
                </div>
                 <div class="form-group mt-2">
                    <label>Staff Salary</label>
                    <input type="text" class="form-control"  name="salary" placeholder="Please Enter Staff Salary" required/>
                </div>
                <div class="form-group mt-2">
                    <label>Staff Password</label>
                    <input type="password" class="form-control"  name="password" placeholder="Please Enter Staff Password" required/>
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



