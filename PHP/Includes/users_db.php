<?php
  //addresses
  include_once($_SERVER["DOCUMENT_ROOT"] . "/Andre_Mashraghi/PHP/Includes/address.php");
  require_once($includes . '/database-creds.php');
  $users_db = mysqli_connect($host, $username, $password, $users_dbS);

  //utf 8 encoding
  $sql = "SET NAMES 'utf8';";
  mysqli_query($users_db, $sql);
