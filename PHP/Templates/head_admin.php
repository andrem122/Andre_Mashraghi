<?php
//addresses
include_once($_SERVER["DOCUMENT_ROOT"] . "/Andre_Mashraghi/PHP/Includes/address.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="robots" content="noindex" />
    <meta name="robots" content="nofollow" />
    <title>Admin Panel</title>
    <link href="https://fonts.googleapis.com/css?family=Libre+Franklin:400,600" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($homeCss, ENT_QUOTES, 'UTF-8', false); ?>" />
    <script src="https://use.fontawesome.com/995faad108.js" defer></script>
    <!--JQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="<?php echo htmlspecialchars("$javascript/admin.js", ENT_QUOTES, 'UTF-8', false); ?>" defer></script>
  </head>
  <body class="admin">
    <div class="body-container">
      <nav class="navbar-top">
        <div class="navbar-wrap">
          <div class="center-content">
            <a href="<?php echo $homeAdd; ?>">
              <?php include($templates . '/logo.php') ?>
            </a>
            <a href="#" class="mobile-button mobile-trigger" data-animate-value="0" data-body="280"><i class="fa fa-bars" aria-hidden="true"></i></a>
            <!-- Mobile Menu -->
            <div class="mobile-menu">
              <div class="icon-close-div mobile-trigger" data-animate-value="-280" data-body="0">
                <i class="fa fa-times icon-close" aria-hidden="true"></i>
              </div>
              <ul>
                <li>
                  <a href="<?php echo htmlspecialchars($admin_index); ?>"><i class="fa fa-home icon-m-right mobile-icons home-b-color" aria-hidden="true"></i>Index</a>
                </li>
                <li>
                  <a href="<?php echo htmlspecialchars($admin_blog_post); ?>"><i class="fa fa-file icon-m-right mobile-icons briefcase-b-color" aria-hidden="true"></i>New Post</a>
                </li>
                <li>
                  <a href="<?php echo htmlspecialchars($admin_work_post); ?>"><i class="fa fa-briefcase icon-m-right mobile-icons briefcase-b-color" aria-hidden="true"></i>New Work</a>
                </li>
                <li>
                  <a href="<?php echo htmlspecialchars($admin_delete); ?>"><i class="fa fa-gamepad icon-m-right mobile-icons pencil-b-color" aria-hidden="true"></i>Delete Post</a>
                </li>
                <li>
                  <a href="<?php echo htmlspecialchars($admin_logout); ?>"><i class="fa fa-trash-o icon-m-right mobile-icons gamepad-b-color" aria-hidden="true"></i>Logout</a>
                </li>
              </ul>
            </div>
            <!-- Main Menu -->
            <div class="main-menu menu-right">
              <ul>
                <li><a href="<?php echo htmlspecialchars($admin_index); ?>"><i class="fa fa-home icon-m-btn-right" aria-hidden="true"></i>Index</a></li>
                <li><a href="<?php echo htmlspecialchars($admin_blog_post); ?>">New Post</a></li>
                <li><a href="<?php echo htmlspecialchars($admin_work_post); ?>">New Work</a></li>
                <li><a href="<?php echo htmlspecialchars($admin_delete); ?>">Delete Post</a></li>
                <li><a href="<?php echo htmlspecialchars($admin_logout); ?>">Logout</a></li>
              </ul>
            </div>
          </div>
        </div>
      </nav>
