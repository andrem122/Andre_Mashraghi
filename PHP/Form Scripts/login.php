<?php
//addresses
include_once($_SERVER["DOCUMENT_ROOT"] . "/Andre_Mashraghi/PHP/Includes/address.php");

//database
include_once($includes . "/users_db.php");

//recaptcha creds
include_once("$includes/recaptcha_creds.php");

//new users
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  //prevent SQL injection
  $uid = mysqli_real_escape_string($users_db, $_POST['uid']);
  $pwd = mysqli_real_escape_string($users_db, $_POST['pwd']);

  //data check
  if(empty($uid) || empty($pwd)) {

    //set a 400 (bad request) response code and exit.
    http_response_code(400);
    echo 'Oops! Please complete all fields and try again.';
    exit();

  } else {

    //recaptcha
    if(isset($_POST['g-recaptcha-response'])) {

      $captcha = $_POST['g-recaptcha-response'];

      //check if recaptcha was clicked
      if(empty($captcha)) {

        http_response_code(400);
        echo 'Please click the captcha to proceed.';
        exit();

      } else {

        //send POST request to google recaptcha
        $data = array('secret' => $secret, 'response' => $captcha, 'remoteip' => $remote_ip);
        $options = array(
          'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data)
          )
        );

        $context = stream_context_create($options);
        $recap_result = file_get_contents($recap_url, false, $context);
        $response_keys = json_decode($recap_result, true);

        if($response_keys['success'] === true) {

          //check credentials
          $sql = "SELECT * FROM users WHERE uid='$uid'";
          $result = mysqli_query($users_db, $sql);
          $num_rows = mysqli_num_rows($result);

          if($result) {

            if($num_rows > 0) {

              $row = mysqli_fetch_assoc($result);

              if(password_verify($pwd, $row['pwd'])) {

                $_SESSION['id']  = $row['id'];
                $_SESSION['uid'] = $row['uid'];
                $_SESSION['email'] = $row['email'];
                http_response_code(200);
                exit();

              } else {

                http_response_code(400);
                echo 'Incorrect password. Please try again.';
                exit();

              }

            } else {

              http_response_code(400);
              echo 'Username not found. Please try again.';
              exit();

            }

          } else {

            http_response_code(500);
            echo 'Oops! Something went wrong. Please try again.';
            exit();

          }

        } else {

          http_response_code(400);
          echo 'Captcha failed. Please try again.';
          exit();

        }

      }

    } else {

      http_response_code(500);
      echo 'Something went wrong. Please try again.';
      exit();

    }

  }
} else {

  //not a POST request. set a 403 (forbidden) response code.
  http_response_code(403);
  header("Location: $blogAdd");

}
