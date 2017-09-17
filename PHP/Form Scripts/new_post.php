<?php

//addresses
include_once($_SERVER['DOCUMENT_ROOT'] . '/Andre_Mashraghi/PHP/Includes/address.php');

//database
include_once($includes . '/blog_db.php');

if($_SERVER['REQUEST_METHOD'] === 'POST') {

  //create directory to store images
  $new_dir     = "$images/Blog/";
  $new_dir_uri = "$images_uri/Blog/";

  if(!file_exists($new_dir)) {

    $oldmask = umask(0);
    mkdir($new_dir, 0777);

  }



  //input data
  $title       = trim($_POST['title']);
  $body        = trim($_POST['body']);

  $user_id     = mysqli_real_escape_string($blog_db, $_SESSION['id']);
  $title       = mysqli_real_escape_string($blog_db, $title);
  $body        = mysqli_real_escape_string($blog_db, $body);
  $category_id = mysqli_real_escape_string($blog_db, $_POST['category']);

  //input check
  if(empty($title) || empty($body) || empty($category_id) || !isset($_FILES['fileToUpload']['name'])
  || $_FILES['fileToUpload']['name'] == UPLOAD_ERR_NO_FILE) {

    http_response_code(400);
    echo 'Oops! Please enter in all fields and try again.';
    exit();

  } else {

    //check file extension
    $image_types = ['jpg', 'png', 'jpeg', 'gif'];

    //image folder location
    $target_file = $new_dir . basename($_FILES['fileToUpload']['name']);
    $target_file_uri = $new_dir_uri . basename($_FILES['fileToUpload']['name']);
    $file_extension = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $target_file_uri = mysqli_real_escape_string($blog_db, $target_file_uri);

    if(in_array($file_extension, $image_types)) {

      //check if file exists
      if(file_exists($target_file)) {

        http_response_code(409);
        echo 'The file already exists!';
        exit();

      } else {

        //move image
        $result_file = move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file);

        if($result_file) {

          //insert data
          $sql = "INSERT INTO posts (user_id, title, body, category_id, date_posted, image_url)
          VALUES ('$user_id', '$title', '$body', '$category_id', NOW(), '$target_file_uri')";

          $result = mysqli_query($blog_db, $sql);

          if($result) {

            http_response_code(200);
            echo 'The post has been added!';
            exit();

          } else {

            http_response_code(500);
            echo 'An error has occurred. Please try again.';
            exit();

          }

        } else {

          http_response_code(409);
          echo 'The image failed to upload. Please Try again.';
          exit();

        }

      }

    } else {

      http_response_code(400);
      echo 'The file must be a jpg, png, jpeg, or gif file';
      exit();

    }

  }
} else {

  //not a post request
  http_response_code(403);
  header("Location: $admin");
  exit();

}
