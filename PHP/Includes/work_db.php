<?php
  //addresses
  include_once($_SERVER["DOCUMENT_ROOT"] . "/Andre_Mashraghi/PHP/Includes/address.php");
  require_once($includes . '/database-creds.php');
  $work_db = mysqli_connect($host, $username, $password, $work_dbS);

  //utf 8 encoding
  $sql = "SET NAMES 'utf8';";
  mysqli_query($work_db, $sql);
