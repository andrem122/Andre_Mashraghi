<?php
//addresses
include_once($_SERVER['DOCUMENT_ROOT'] . '/Andre_Mashraghi/PHP/Includes/address.php');

//database
include_once($includes . '/users_db.php');
//require the kickout
require_once($includes . '/kickout.php');

if($_SERVER['REQUEST_METHOD'] === 'POST') {

  $comment_id   = mysqli_real_escape_string($users_db, $_POST['commentId']);
  $button_class = mysqli_real_escape_string($users_db, $_POST['buttonClass']);

  switch ($button_class) {
    case 'approve-comment':
      $sql = "UPDATE comments SET approved=1 WHERE id='$comment_id';";
      break;
    case 'unapprove-comment':
      $sql = "UPDATE comments SET approved=0 WHERE id='$comment_id';";
      break;
    case 'trash-comment':
      $sql = "DELETE FROM comments WHERE id='$comment_id';";
      break;
    default:
      exit();
  }

  $result = mysqli_query($users_db, $sql);

  if($result) {

    http_response_code(200);
    echo 'Comment Approved';

  } else {

    http_response_code(500);
    echo 'Oops! Something went wrong. Please try again.';
    exit();

  }

} else {

  //not a post request
  http_response_code(403);
  header("Location: $admin");
  exit();

}
