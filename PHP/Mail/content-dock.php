<?php
//addresses
include_once($_SERVER["DOCUMENT_ROOT"] . "/Andre_Mashraghi/PHP/Includes/address.php");
require_once($mail . "/vendor/autoload.php");
//form
if($_SERVER["REQUEST_METHOD"] === "POST") {
  //form data submitted by user
  $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
  $message = strip_tags(trim($_POST["message"]));
  // Check that data was sent to the mailer.
  if(empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    // Set a 400 (bad request) response code and exit.
    http_response_code(400);
    echo "Oops! Please complete all fields and try again.";
    exit;
  }
  $message = "Hello!
     Your contact form has been submitted:<br>\r\n
     <b>Email:</b> $email<br>\r\n
     <b>Message:</b> $message";
  $mail = new PHPMailer;
  $mail->IsSMTP();
  $mail->SMTPAuth = true;
  $mail->SMTPDebug = 0;
  $mail->Host = "smtp.gmail.com";
  $mail->Username = 'andre.mashraghi@gmail.com';
  $mail->Password = '2486[*angel52Ax]';
  $mail->SMTPSecure = 'ssl';
  $mail->Port = 465;
  $mail->setFrom($email, 'Hire');
  $mail->addReplyTo($email);
  $mail->addAddress('andre@andremashraghi.com');
  $mail->Subject = "Content Dock: Hire Me";
  $mail->Body    = $message;
  $mail->AltBody = $message;
  if(!$mail->send()) {
      http_response_code(500);
      echo 'Message could not be sent.';
      echo 'Mailer Error: ' .$mail->ErrorInfo;
      exit;
  } else {
      http_response_code(200);
      echo 'Your Message has been sent!';
      exit;
  }
} else {
  if(isset($_POST['submit'])) {
    //not a POST request, set a 403 (forbidden) response code.
    http_response_code(403);
    echo "There was a problem with your submission, please try again.";
  }
}
?>
