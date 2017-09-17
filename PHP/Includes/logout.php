<?php
  //addresses
  include_once($_SERVER["DOCUMENT_ROOT"] . "/Andre_Mashraghi/PHP/Includes/address.php");
  session_destroy();
  session_unset();
  header("Location: $blogAdd");
  exit();
?>
