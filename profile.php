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

      <!--Account-->
      <section class="my-5 py-5">
         <div class="row mx-auto">

         
          
             <div class="text-center mt-3 pt-5 col-lg-12 col-md-12 col-sm-12">
             
                 <h3 class="font-weight-bold">Account info</h3>
                 <hr class="mx-auto">
                 <div class="account-info">
                     <p>Id      :<span> <?php if(isset($_SESSION['admin_name'])){ echo $_SESSION['id'];} ?></span></p>
                     <p>Username:<span> <?php if(isset($_SESSION['admin_name'])){ echo $_SESSION['username'];} ?></span></p>
                     <p>Name    :<span> <?php if(isset($_SESSION['admin_name'])){ echo $_SESSION['admin_name'];} ?></span></p>
                     <p>Email   :<span> <?php if(isset($_SESSION['admin_email'])){ echo $_SESSION['admin_email'];} ?></span></p>
                 </div>
             </div>

            
         </div>
      </section>
</body>
</html>
