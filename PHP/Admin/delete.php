<?php
  //addresses
  include_once($_SERVER["DOCUMENT_ROOT"] . "/Andre_Mashraghi/PHP/Includes/address.php");

  //access database
  require_once($includes . "/blog_db.php");
  require_once($includes . "/work_db.php");

  //require the kickout
  require_once($includes . "/kickout.php");

?>
      <?php include_once($templates . "/head_admin.php"); ?>
        <div class="main-content-wrapper">
          <div class="center-content">
            <div class="post-center">
              <div class="row">
                <h2>Delete Blog Post</h2>
                <div class="form-container">
                  <form id="form-del-blog" action="<?php echo htmlspecialchars("$form_scripts_uri/delete.php", ENT_QUOTES, 'UTF-8', false); ?>" method="POST">
                    <label for="del-blog-title">Title</label>
                    <input id="del-blog-title" type="text" name="del-blog-title" />
                    <input class="button" type="submit" name="submitb" value="Delete Post" />
                  </form>
                  <div class="form-messages"></div>
                </div>
              </div>
              <div class="row">
                <h2>Delete Work Post</h2>
                <div class="form-container">
                  <form id="form-del-work" action="<?php echo htmlspecialchars("$form_scripts_uri/delete.php", ENT_QUOTES, 'UTF-8', false); ?>" method="POST">
                    <label for="del-work-url">Work Link</label>
                    <input id="del-work-url" type="text" name="del-work-url" />
                    <input class="button" type="submit" name="submitw" value="Delete Post" />
                  </form>
                  <div class="form-messages"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
