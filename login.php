<?php include('layouts/admin_login_header.php'); ?>

<?php
include('config/db.php');

if(isset($_SESSION['admin_logged_in'])){
    ?>
    <script>
      window.location.href="index.php"
    </script>
    <?php
    
    exit;
}


if(isset($_POST['login_btn'])){

    $email = $_POST['email'];
    $password = $_POST['password'];
  
    $stmt = $conn->prepare("SELECT id,admin_name, admin_email, admin_password FROM admins WHERE admin_email = ? LIMIT 1");
  
    $stmt->bind_param('s',$email);
  
    if($stmt->execute()){
        $stmt->bind_result($admin_id,$admin_name,$admin_email,$hashed_password);
        $stmt->store_result();
  
        if($stmt->num_rows() == 1){
           $stmt->fetch();
           
           if(password_verify($password, $hashed_password)) {
              $_SESSION['admin_id'] = $admin_id;
              $_SESSION['admin_name'] = $admin_name;
              $_SESSION['admin_email'] = $admin_email;
              $_SESSION['admin_logged_in'] = true;

              // Use this to prevent session hijacking
              session_regenerate_id(true);
              
              ?>
              <script>
                window.location.href="index.php?login_success=logged in successfully"
              </script>
              <?php
           } else {
              ?>
              <script>
                window.location.href="login.php?error=incorrect password"
              </script>
              <?php
           }
  
        }else{
          ?>
          <script>
            window.location.href="login.php?error=could not verify your account"
          </script>
          <?php
        }
  
      }else{
  
      ?>
      <script>
        window.location.href="login.php?error=something went wrong"
      </script>
      <?php
    }
  
  }
  
?>

<section id="myDiv" class="animate-bottom" style="">
    <div class="image_container">
        <img src="images/backgroundimage.jpg" alt="">
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-4">
                <form action="login.php" method="POST">
                    <p style="color: red;"><?php if(isset($_GET['error'])){ echo $_GET['error']; }?></p>
                    <div class="forms">
                        <div class="login_image">
                            <img src="images/avatar.png" alt="">
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter Your Email">
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control"  placeholder="Enter Your Password" id="myInput">
                            <i class="far fa-eye" id="togglePassword" style="cursor: pointer;"></i>
                        </div>

                        <!-- reCaptcha -->

                        <div class="g-recaptcha" data-sitekey="6LeKaIsmAAAAAH2Cf5brXPrkJaA_FsdZMd-XlrO7"></div>

                        <!-- Forget Password -->

                        <div class="submit_button">
                            <button type="submit" class="btn btn-success mt-3" id="login_btn" name="login_btn">Login</button>
                            <!-- <a href="#"><p>Forgot Password?</p></a> -->
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
          var myVar;

          function myFunction() {
          myVar = setTimeout(showPage, 200);
          }

          function showPage() {
          document.getElementById("loader").style.display = "none";
          document.getElementById("myDiv").style.display = "block";
          }
    </script>


<script type="text/javascript">

    $document.on('click','#login_btn',function(){
          var response = grecaptcha.getResponse();
          alert(response.length);

    });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
  



</body>
</html>
