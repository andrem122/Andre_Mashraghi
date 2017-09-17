<?php

//login form

//addresses
include_once($_SERVER["DOCUMENT_ROOT"] . "/Andre_Mashraghi/PHP/Includes/address.php");

?>
<div class="form-container">
  <header class="signup-header">
    <h2>Login</h2>
  </header>
  <form id="form-login" action="<?php echo htmlspecialchars("$form_scripts_uri/login.php", ENT_QUOTES, 'UTF-8', false); ?>" method="POST">
    <div class="row">
      <div class="form-group no-margin-bottom">
        <label for="uid">Username</label>
        <input type="text" id="uid" name="uid" placeholder="johnDill" required />
      </div>
    </div>
    <div class="row">
      <div class="form-group">
        <label for="pwd">Password</label>
        <input type="password" id="pwd" name="pwd" placeholder="Password" required />
      </div>
    </div>
    <div class="row">
      <div class="form-group">
        <div class="g-recaptcha" data-sitekey="6LdsbjAUAAAAANHLotME2nlD7Hvzmg-_xopOU5nO"></div>
        <input class="button" type="submit" name="submit" value="Log In" />
      </div>
    </div>
  </form>
  <div class="form-messages"></div>
</div>
