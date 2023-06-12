<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/PHPMailer/src/Exception.php';
require 'vendor/PHPMailer/src/PHPMailer.php';
require 'vendor/PHPMailer/src/SMTP.php';

require 'includes/init.php';

$email = '';
$subject = '';
$message = '';
$sent = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $errors = [];

    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        $errors[] = 'Please enter a valid email address';
    }

    if ($subject == '') {
        $errors[] = 'Please enter a subject';
    }

    if ($message == '') {
        $errors[] = 'Please enter a message';
    }

    if (empty($errors)) {

        $mail = new PHPMailer(true);

        try {

            $mail->isSMTP();
            $mail->Host = 'smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = '16a37b065c4a46';
            $mail->Password = '3b60be2de94a5f';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('sender@example.com');
            $mail->addAddress('recipient@example.com');
            $mail->addReplyTo($email);
            $mail->Subject = $subject;
            $mail->Body = $message;

            $mail->send();

            $sent = true;

        } catch (Exception $e) {

            $errors[] = $mail->ErrorInfo;

        }
    }
}

?>
<?php require 'layouts/header.php'; ?>


<div class="container-fluid">
  <div class="row"  style="min-height: 100%">

  <main class="col-md-9 ms-sm-auto col-lg-12 px-md-4">
      <div class="row">
           <div class="col-12">
               <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                   <h3 class="mb-sm-0  pt-5">Contact Developer</h3>
                   <div class="page-title-right menu">
                       <ol class="breadcrumb pt-5">
                           <li class="breadcrumb-item">Awesome Store</li>
                           <li class="breadcrumb-item active">Help</li>
                       </ol>
                   </div>
               </div>

           </div>
       </div>

       <?php if ($sent) : ?>
    <p>Message sent.</p>

<?php else: ?>

    <?php if (! empty($errors)) : ?>
        <ul>
            <?php foreach ($errors as $error) : ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

          <div class="mx-auto container">
          <form method="post" id="formContact">
                <div class="form-group mt-2">
                    <label for="email">Your email</label>
                    <input class="form-control" name="email" id="email" type="email" placeholder="Please Enter a Valid Email" value="<?= htmlspecialchars($email) ?>">
                </div>

                <div class="form-group mt-2">
                    <label for="subject">Subject</label>
                    <input class="form-control" name="subject" id="subject" placeholder="Please Enter your Subject" value="<?= htmlspecialchars($subject) ?>">
                </div>

                <div class="form-group mt-2">
                    <label for="message">Message</label>
                    <textarea class="form-control" name="message" id="message" placeholder="Please Enter the Message"><?= htmlspecialchars($message) ?></textarea>
                </div>


                <button class="btn btn-primary mt-3">Send</button>

                </form>
                <?php endif; ?>
          </div>
      </div>
    </main>
  </div>
</div>




    




