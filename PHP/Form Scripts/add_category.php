<?php

//addresses
include_once($_SERVER['DOCUMENT_ROOT'] . '/Andre_Mashraghi/PHP/Includes/address.php');

//database
include_once($includes . '/blog_db.php');

//get post data from form
if($_SERVER['REQUEST_METHOD'] === 'POST') {

  $add_category = trim($_POST['add-category']);

  $add_category = mysqli_real_escape_string($blog_db, $add_category);

  //check if empty
  if(empty($add_category)) {

    http_response_code(400);
    echo 'Please enter a category.';
    exit();

  } else {

    //check for valid characters
    $patt  = '/^[a-zA-z\s]+$/';
    if(!preg_match($patt, $add_category)) {

      http_response_code(400);
      echo 'Please enter only letters.';
      exit();

    } else {

      $sql = "INSERT INTO categories (category) VALUES ('$add_category')";
      $result = mysqli_query($blog_db, $sql);

      if($result) {

        http_response_code(200);
        echo 'Your category has been added!';

      } else {

        http_response_code(500);
        echo 'Your category could not be added at this time. Please try again.';
        exit();

      }

    }

  }

} else {

  //not a post request
  http_response_code(403);
  header("Location: $admin");
  exit();

}
