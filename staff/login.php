<?php 

include('layouts/staff_login_header.php'); 
// Set secure cookie parameters
session_set_cookie_params([
  'secure' => true,      // only send cookie over HTTPS
  'httponly' => true,    // hide cookie from JavaScript
  'samesite' => 'Strict' // cookie only sent for same-site requests
]);

include('config/db.php');

if(isset($_POST['login_btn'])){

    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
  
    $stmt = $conn->prepare("SELECT id, staff_name, staff_email, staff_password FROM staffs WHERE staff_email = ? LIMIT 1");
  
    $stmt->bind_param('s',$email);
  
    if($stmt->execute()){
        $stmt->bind_result($staff_id, $staff_name, $staff_email,$hashed_password);
        $stmt->store_result();
  
        if($stmt->num_rows() == 1) {
           $stmt->fetch();
           
           if(password_verify($password, $hashed_password)) {
              $_SESSION['staff_id'] = $staff_id;
              $_SESSION['staff_name'] = $staff_name;
              $_SESSION['staff_email'] = $staff_email;
              $_SESSION['staff_logged_in'] = true;

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

<section id="myDiv" class="animate-bottom" >
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
                            <input type="password" name="password" class="form-control" placeholder="Enter Your Password" id="password-field">
                            <button type="button" id="toggle-password" style="cursor: pointer;" class="mt-2 mb-2 btn btn-dark mt-3 ">Show</button>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script>
    $(function() {
        $('#toggle-password').click(function() {
            if ($(this).text() === 'Show') {
                $(this).text('Hide');
                $('#password-field').attr('type', 'text');
            } else {
                $(this).text('Show');
                $('#password-field').attr('type', 'password');
            }
        });
        
        $('form button[type="submit"]').on('click', function() {
            $('#toggle-password').text('Show');
            $('#password-field').attr('type', 'password');
        });
    });
</script>

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
        $(document).ready(function() {
            $('#login_btn').click(function(e){
                var response = grecaptcha.getResponse();
                if(response.length == 0) { 
                    //reCaptcha not verified
                    alert("Please verify you are not a robot."); 
                    e.preventDefault();
                    return false;
                }
                //captcha verified
                //do the rest of your validations here
            });
        });
    </script>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
  



</body>
</html>
