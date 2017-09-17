<?php

//addresses
include_once($_SERVER['DOCUMENT_ROOT'] . '/Andre_Mashraghi/PHP/Includes/address.php');

//database
require_once($includes . '/blog_db.php');
require_once($includes . '/work_db.php');

if($_SERVER['REQUEST_METHOD'] === 'POST') {

  //blog posts
  if($_POST['formId'] === 'form-del-blog') {

    $title = trim($_POST['del-blog-title']);

    $title = mysqli_real_escape_string($blog_db, $title);

    //check if empty
    if(empty($title)) {

      http_response_code(400);
      echo 'Oops! Please enter a title and try again.';
      exit();

    } else {

      //check if post exists
      $sqlb = "SELECT * FROM posts WHERE title='$title'";
      $resultb = mysqli_query($blog_db, $sqlb);

      if($resultb) {

        $num_rows = mysqli_num_rows($resultb);

        if($num_rows > 0) {

          $sqlb = "DELETE FROM posts WHERE title='$title' LIMIT 1";
          $resultb = mysqli_query($blog_db, $sqlb);

          //check if query is successful
          if($resultb) {

            http_response_code(200);
            echo 'The post has been deleted.';
            exit();

          } else {

            http_response_code(500);
            echo 'The post could not be deleted at this time. Please try again.';
            exit();

          }

        } else {

          http_response_code(400);
          echo 'Post does not exist. Please try again.';
          exit();

        }

      } else {

        http_response_code(500);
        echo 'Something went wrong. Please try again.';
        exit();

      }

    }

  }

  //work posts
  if($_POST['formId'] === 'form-del-work') {

    $work_url = trim($_POST['del-work-url']);

    $work_url = mysqli_real_escape_string($work_db, $work_url);

    //check if empty
    if(empty($work_url)) {

      http_response_code(400);
      echo 'Oops! Please enter a url and try again.';
      exit();

    } else {

      //check if post exists
      $sqlw = "SELECT * FROM work_examples WHERE work_url='$work_url'";
      $resultw = mysqli_query($work_db, $sqlw);

      if($resultw) {

        $num_rows = mysqli_num_rows($resultw);

        if($num_rows > 0) {

          $sqlw = "DELETE FROM work_examples WHERE work_url='$work_url' LIMIT 1";
          $resultw = mysqli_query($work_db, $sqlw);

          //check if query is successful
          if($resultw) {

            http_response_code(200);
            echo 'The post has been deleted.';
            exit();

          } else {

            http_response_code(500);
            echo 'The post could not be deleted at this time. Please try again.';
            exit();

          }

        } else {

          http_response_code(400);
          echo 'URL does not exist. Please try again.';
          exit();

        }

      } else {

        http_response_code(500);
        echo 'Something went wrong. Please try again.';
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
