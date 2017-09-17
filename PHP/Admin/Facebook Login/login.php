<?php
  //addresses
  include_once($_SERVER["DOCUMENT_ROOT"] . "/Andre_Mashraghi/PHP/Includes/address.php");
  require_once __DIR__ . '/vendor/autoload.php';
  require_once $includes . "/fb-creds.php";

  $fb = new Facebook\Facebook([
  'app_id' => $app_id,
  'app_secret' => $app_secret,
  'default_graph_version' => 'v2.2',
  ]);

$helper = $fb->getRedirectLoginHelper();

$permissions = ['email']; // Optional permissions
$loginUrl = $helper->getLoginUrl($fb_url, $permissions);
?>

<!DOCTYPE html>
<html class="admin-login">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="robots" content="noindex" />
    <meta name="robots" content="nofollow" />
    <title>Admin Login</title>
    <link href="https://fonts.googleapis.com/css?family=Libre+Franklin:400,600" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="<?php echo $homeCss; ?>" />
    <script src="https://use.fontawesome.com/995faad108.js" defer></script>
  </head>
  <body class="admin-login">
    <div class="main-content-wrapper">
      <div class="center-content flex-center-h-v">
          <div class="facebook-login">
            <h1>Admin Login</h1>
            <p>Hey, beautiful! Welcome back to your admin login screen!</p>
            <a id="facebook-button" class="button" href="<?php echo htmlspecialchars($loginUrl); ?>"><i class="fa fa-facebook" aria-hidden="true"></i>Facebook</a>
          </div>
      </div>
    </div>
  </body>
</html>
