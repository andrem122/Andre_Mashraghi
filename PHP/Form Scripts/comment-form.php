<?php
//addresses
include_once($_SERVER["DOCUMENT_ROOT"] . "/Andre_Mashraghi/PHP/Includes/address.php");

//database
include_once($includes . "/users_db.php");

//recaptcha credentials
include_once($includes . "/recaptcha_creds.php");

//form data
if($_SERVER["REQUEST_METHOD"] === "POST") {
  //existing users
  if(isset($_SESSION['id']) && isset($_SESSION['uid']) && isset($_SESSION['post_id']) && isset($_SESSION['email'])) {

    $uid        = mysqli_real_escape_string($users_db, $_SESSION['uid']);
    $comment    = mysqli_real_escape_string($users_db, $_POST['comment']);
    $post_title = mysqli_real_escape_string($users_db, $_SESSION['post_title']);
    $post_id    = mysqli_real_escape_string($users_db, $_SESSION['post_id']);

    //check if comment is submitted
    if(empty($comment)) {

      http_response_code(400);
      echo 'Please type in a comment.';
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

            $sql = "INSERT INTO comments (uid, comment, post_title, post_id, date) VALUES ('$uid', '$comment', '$post_title', '$post_id', NOW());";
            $result = mysqli_query($users_db, $sql);

            if($result) {

              http_response_code(200);
              echo 'Your comment has been submitted!';
              mysqli_close($users_db);
              exit();

            } else {

              http_response_code(500);
              echo 'Comment could not be posted. Please try again.';
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
    //new users
    //remove whitespace
    $first = trim($_POST['first']);
    $last  = trim($_POST['last']);
    $email = trim($_POST['email']);

    //prevent SQL injection
    $first      = mysqli_real_escape_string($users_db, $first);
    $last       = mysqli_real_escape_string($users_db, $last);
    $email      = mysqli_real_escape_string($users_db, $email);
    $uid        = mysqli_real_escape_string($users_db, $_POST['uid']);
    $comment    = mysqli_real_escape_string($users_db, $_POST['comment']);
    $pwd        = mysqli_real_escape_string($users_db, $_POST['pwd']);
    $post_title = mysqli_real_escape_string($users_db, $_SESSION['post_title']);
    $post_id    = mysqli_real_escape_string($users_db, $_SESSION['post_id']);

    //data check
    if(empty($first) || empty($last) || empty($uid) || empty($comment) || empty($pwd) || empty($email)) {

      //set a 400 (bad request) response code and exit.
      http_response_code(400);
      echo "Oops! Please complete all fields and try again.";
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

            //check for valid characters
            $patt  = '/^[a-zA-z\s]+$/';
            $admin_patt  = '/admin/i';

            if(!preg_match($patt, $first) || !preg_match($patt, $last) || preg_match($admin_patt, $uid) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {

              http_response_code(400);
              echo 'Please enter a valid name, username, and email.';
              exit();

            } else {

              //check if username exists
              $sql = "SELECT * FROM users WHERE uid='$uid'";
              $result = mysqli_query($users_db, $sql);
              $num_rows = mysqli_num_rows($result);

              if($num_rows > 0) {

                http_response_code(401);
                echo 'Username already exists!';
                exit();

              } else {

                //encrypt the password
                $hashed_password = password_hash($pwd, PASSWORD_DEFAULT);

                //insert into database
                mysqli_begin_transaction($users_db, MYSQLI_TRANS_START_READ_WRITE);

                $sql = "INSERT INTO users (first, last, uid, email, pwd) VALUES ('$first', '$last', '$uid', '$email', '$hashed_password');";

                $result1 = mysqli_query($users_db, $sql);

                $sql = "INSERT INTO comments (uid, comment, post_title, post_id, date) VALUES ('$uid', '$comment', '$post_title', '$post_id', NOW());";

                $result2 = mysqli_query($users_db, $sql);

                $sql = "SELECT * FROM users WHERE uid='$uid' AND pwd='$hashed_password';";

                $result3 = mysqli_query($users_db, $sql);

                mysqli_commit($users_db);

                if($result1 === false || $result2 === false || $result3 === false) {

                  http_response_code(500);
                  echo 'Comment could not be posted. Please try again.';
                  exit();

                } else {

                  http_response_code(200);
                  echo 'Your comment has been submitted!';
                  $row = mysqli_fetch_assoc($result3);

                  //set session variables
                  $_SESSION['id']  = $row['id'];
                  $_SESSION['uid'] = $row['uid'];
                  $_SESSION['email'] = $row['email'];
                  exit();

                }

                mysqli_close($users_db);

              }

            }

            if($result) {

              http_response_code(200);
              echo 'Your comment has been submitted!';
              mysqli_close($users_db);
              exit();

            } else {

              http_response_code(500);
              echo 'Comment could not be posted. Please try again.';
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

  }
} else {
    //not a POST request. set a 403 (forbidden) response code.
    http_response_code(403);
    header("Location: $admin");
    exit();
}
