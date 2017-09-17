<?php
//addresses
include_once($_SERVER["DOCUMENT_ROOT"] . "/Andre_Mashraghi/PHP/Includes/address.php");
?>
<div class="content-dock left">
  <a href="#" class="close-content-dock" data-animate="-425px">
    <i class="fa fa-times" aria-hidden="true"></i>
  </a>
  <h4 class="content-dock-title">Hire Me!</h4>
  <div class="form-messages"></div>
  <div class="content-dock-content">
    <div class="form-container">
      <form id="form-contentdock" action="<?php echo htmlspecialchars("$mailUri/content-dock.php", ENT_QUOTES, 'UTF-8', false); ?>" method="POST">
        <div class="form-group">
          <label for="email">Email (required)</label>
          <input type="email" id="email" name="email" placeholder="Tom@AndreIsAwesome.com" required />
        </div>
        <div class="form-group">
          <label for="message">Message (required)</label>
          <textarea rows="5" cols="50" id="message" spellcheck="true" name="message" placeholder="Hi there!" required></textarea>
        </div>
        <div class="form-group">
          <input class="button" type="submit" value="Hire Me" />
        </div>
      </form>
    </div>
  </div>
</div>
