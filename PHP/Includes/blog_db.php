<?php
  //addresses
  include_once($_SERVER["DOCUMENT_ROOT"] . "/Andre_Mashraghi/PHP/Includes/address.php");
  require_once($includes . '/database-creds.php');
  $blog_db = mysqli_connect($host, $username, $password, $blog_dbS);

  //utf 8 encoding
  $sql = "SET NAMES 'utf8';";
  mysqli_query($blog_db, $sql);
