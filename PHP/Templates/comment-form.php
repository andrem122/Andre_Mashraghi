<?php
//addresses
include_once($_SERVER["DOCUMENT_ROOT"] . "/Andre_Mashraghi/PHP/Includes/address.php");
?>
<div class="center-content">
  <header class="signup-header">
    <h2>Leave A Comment</h2>
  </header>
  <div class="form-container">
    <form id="form-comment" action="<?php echo htmlspecialchars("$form_scripts_uri/comment-form.php", ENT_QUOTES, 'UTF-8', false); ?>" method="POST">
      <?php if(!isset($_SESSION['id']) && !isset($_SESSION['uid'])): ?>
      <div class="row">

        <div class="form-group col-sm-6 no-margin-bottom">
          <label for="first">First Name (required)</label>
          <input type="text" id="first" name="first" placeholder="John" required />
        </div>

        <div class="form-group col-sm-6 no-margin-bottom">
          <label for="last">Last Name (required)</label>
          <input type="text" id="last" name="last" placeholder="Dill" required />
        </div>

      </div>
      <div class="row">

        <div class="form-group col-sm-6 no-margin-bottom">
          <label for="email">E-mail Address</label>
          <input type="email" id="email" name="email" placeholder="johnDill@john.com" required />
        </div>

        <div class="form-group col-sm-6 no-margin-bottom">
          <label for="uid">Choose Your Username</label>
          <input type="text" id="uid" name="uid" placeholder="johnDill" required />
        </div>

      </div>
      <div class="form-group">
        <label for="pwd">Create A Password</label>
        <input type="password" id="pwd" name="pwd" placeholder="Password"  required />
      </div>
      <?php else: ?>
      <div class="login-status">
        <p>
          Logged in as <span class="username"><?php $uid = isset($_SESSION['uid']) ? ($_SESSION['uid']) : ''; echo htmlspecialchars($uid, ENT_QUOTES, 'UTF-8', false); ?>.</span> <a href="<?php echo htmlspecialchars("$includes_uri/logout.php", ENT_QUOTES, 'UTF-8', false); ?>">Log out?</a>
        </p>
      </div>
      <?php endif; ?>
      <div class="form-group">
        <label for="comment">Comment</label>
        <textarea rows="5" cols="50" id="comment" spellcheck="true" name="comment" placeholder="Hi there!" required></textarea>
      </div>
      <div class="form-group">
        <div class="g-recaptcha" data-sitekey="6LdsbjAUAAAAANHLotME2nlD7Hvzmg-_xopOU5nO"></div>
        <input class="button" type="submit" name="submit" value="Post Comment" />
      </div>
    </form>
  </div>
  <div class="form-messages"></div>
</div>
