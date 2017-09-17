<?php
//addresses
include_once($_SERVER["DOCUMENT_ROOT"] . "/Andre_Mashraghi/PHP/Includes/address.php");
?>
<nav class="navbar-top">
  <div class="navbar-wrap">
    <div class="center-content">
      <a href="<?php echo htmlspecialchars($homeAdd, ENT_QUOTES, 'UTF-8', false); ?>">
        <?php include($templates . "/logo.php"); ?>
      </a>
      <a href="#" class="mobile-button mobile-trigger" data-animate-value="0" data-body="280"><i class="fa fa-bars" aria-hidden="true"></i></a>
      <!-- Mobile Menu -->
      <div class="mobile-menu">
        <div class="icon-close-div mobile-trigger" data-animate-value="-280" data-body="0">
          <i class="fa fa-times icon-close" aria-hidden="true"></i>
        </div>
        <ul>
          <li><a href="<?php echo htmlspecialchars($homeAdd, ENT_QUOTES, 'UTF-8', false); ?>"><i class="fa fa-home icon-m-right mobile-icons home-b-color" aria-hidden="true"></i>Home</a></li>
          <li><a data-nav="#my-work" href="#"><i class="fa fa-briefcase icon-m-right mobile-icons briefcase-b-color" aria-hidden="true"></i>My Work</a></li>
          <li><a data-nav="#my-skills" href="#"><i class="fa fa-gamepad icon-m-right mobile-icons pencil-b-color" aria-hidden="true"></i>Skills</a></li>
          <li><a href="<?php echo htmlspecialchars($blogAdd, ENT_QUOTES, 'UTF-8', false); ?>"><i class="fa fa-pencil icon-m-right mobile-icons gamepad-b-color" aria-hidden="true"></i>Blog</a></li>
          <li><a href="<?php echo htmlspecialchars($loginAdd, ENT_QUOTES, 'UTF-8', false); ?>"><i class="fa fa-sign-in icon-m-right mobile-icons login-b-color" aria-hidden="true"></i>
Login</a></li>
        </ul>
      </div>
      <!-- Main Menu -->
      <div class="main-menu menu-right">
        <ul>
          <li><a href="<?php echo htmlspecialchars($homeAdd, ENT_QUOTES, 'UTF-8', false); ?>"><i class="fa fa-home icon-m-btn-right" aria-hidden="true"></i>Home</a></li>
          <li><a data-nav="#my-work" href="#">My Work</a></li>
          <li><a data-nav="#my-skills" href="#">Skills</a></li>
          <li><a href="<?php echo htmlspecialchars($blogAdd, ENT_QUOTES, 'UTF-8', false); ?>">Blog</a></li>
          <li><a href="<?php echo htmlspecialchars($loginAdd, ENT_QUOTES, 'UTF-8', false); ?>">Login</a></li>
        </ul>
      </div>
    </div>
  </div>
</nav>
