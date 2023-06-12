
<?php include('layouts/header.php'); ?>
<?php
include('config/db.php');

if(!isset($_SESSION['staff_logged_in'])){
    ?>
    <script>
      window.location.href="login.php"
    </script>
    <?php
  exit;
}

?>

      <!--Account-->
      <section class="my-5 py-5">
         <div class="row mx-auto">

         
          
             <div class="text-center mt-3 pt-5 col-lg-12 col-md-12 col-sm-12">
             
                 <h3 class="font-weight-bold">Account info</h3>
                 <hr class="mx-auto">
                 <div class="account-info">
                     <p>Id      :<span> <?php if(isset($_SESSION['id'])){ echo $_SESSION['id'];} ?></span></p>
                     <p>Name    :<span> <?php if(isset($_SESSION['staff_name'])){ echo $_SESSION['staff_name'];} ?></span></p>
                     <p>Age:<span> <?php if(isset($_SESSION['staff_age'])){ echo $_SESSION['staff_age'];} ?></span></p>
                     <p>Email    :<span> <?php if(isset($_SESSION['staff_email'])){ echo $_SESSION['staff_email'];} ?></span></p>
                     <p>Address   :<span> <?php if(isset($_SESSION['staff_address'])){ echo $_SESSION['staff_address'];} ?></span></p>
                 </div>
             </div>

            
         </div>
      </section>
</body>
</html>
