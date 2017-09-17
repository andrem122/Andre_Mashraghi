<?php
  //addresses
  include_once($_SERVER['DOCUMENT_ROOT'] . '/Andre_Mashraghi/PHP/Includes/address.php');
  require_once($includes . '/fb-creds.php');
  
  if(isset($_SESSION['name']) && isset($_SESSION['id']) && $_SESSION['email']) {
    if($_SESSION['name'] !== $admin_name || $_SESSION['id'] !== $fb_id || $_SESSION['email'] !== $admin_email) {

      header("Location: $admin");
      exit();

    }
  } else {

    http_response_code(403);
    header("Location: $admin");

  }
?>
