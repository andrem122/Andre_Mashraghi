<?php
//addresses
include_once($_SERVER["DOCUMENT_ROOT"] . "/Andre_Mashraghi/PHP/Includes/address.php");
//database
include_once($includes . "/users_db.php");
?>
<!DOCTYPE html>
<html class="b-h-overflow-hidden login" lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Looking to login to Andre Mashraghi&#039;s website? Look no further!"/>
    <meta name="robots" content="noodp"/>
    <link rel="canonical" href="http://andremashraghi.com/" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Login to Andre Mashraghi" />
    <meta property="og:description" content="Looking to login to Andre Mashraghi&#039;s website? Look no further!" />
    <meta property="og:url" content="http://andremashraghi.com/" />
    <meta property="og:site_name" content="Andre M." />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:description" content="Looking to login to Andre Mashraghi&#039;s website? Look no further!" />
    <meta name="twitter:title" content="Login to Andre Mashraghi" />
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css?family=Libre+Franklin:400,600" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($homeCss, ENT_QUOTES, 'UTF-8', false); ?>" />
    <script src="https://use.fontawesome.com/995faad108.js" defer></script>
    <!--JQuery-->
    <script
      src="https://code.jquery.com/jquery-3.2.1.min.js"
      integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
      crossorigin="anonymous">
    </script>
    <!--Throttle Js-->
    <script src="<?php echo htmlspecialchars("$plugins/throttle.js", ENT_QUOTES, 'UTF-8', false); ?>" defer></script>
    <!--Login Js-->
    <script src="<?php echo htmlspecialchars($loginJs, ENT_QUOTES, 'UTF-8', false); ?>" defer></script>
    <script src='https://www.google.com/recaptcha/api.js' defer></script>
  </head>
  <body class="b-h-overflow-hidden login">
    <?php include_once($templates . '/loader.php') ?>
    <div style="opacity: 0" class="body-container">
      <?php include_once("$templates/login.php"); ?>
    </div>
  </body>
</html>
