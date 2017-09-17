<?php

//addresses
include_once($_SERVER['DOCUMENT_ROOT'] . '/Andre_Mashraghi/PHP/Includes/address.php');

//database
include_once($includes . '/work_db.php');

if($_SERVER['REQUEST_METHOD'] === 'POST') {

  //create directory to store images
  $new_dir     = "$images/Work/";
  $new_dir_uri = "$images_uri/Work/";

  if(!file_exists($new_dir)) {

    $oldmask = umask(0);
    mkdir($new_dir, 0777);

  }



  //input data
  $work_url = trim($_POST['work_url']);

  $work_url = mysqli_real_escape_string($work_db, $work_url);


  //input check
  if(empty($work_url) || !isset($_FILES['fileToUpload']['name'])
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

    $target_file_uri = mysqli_real_escape_string($work_db, $target_file_uri);

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
          $sql = "INSERT INTO work_examples (work_url, work_image_url)
          VALUES ('$work_url', '$target_file_uri')";

          $result = mysqli_query($work_db, $sql);

          if($result) {

            http_response_code(200);
            echo 'The work example has been added!';
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
