<?php
  //addresses
  include_once($_SERVER["DOCUMENT_ROOT"] . "/Andre_Mashraghi/PHP/Includes/address.php");

  //require the database
  include_once($includes . "/blog_db.php");

  //require the kickout
  require_once($includes . "/kickout.php");

  //post count
  $sql = "SELECT * FROM posts";
  $result = mysqli_query($blog_db, $sql);

  $post_count = mysqli_num_rows($result);

?>
      <?php include_once($templates . "/head_admin.php"); ?>
      <main class="main-content-wrapper">
        <div class="center-content">
          <div class="row">
            <div class="col-sm-4 post-count">
              <h2>Total Blog Posts</h2>
              <span><?php echo htmlspecialchars($post_count, ENT_QUOTES, 'UTF-8', false); ?></span>
            </div>
            <div class="col-sm-4">
              <div class="form-container">
                <form id="form-category" action="<?php echo htmlspecialchars("$form_scripts_uri/add_category.php", ENT_QUOTES, 'UTF-8', false); ?>" method="post">
                  <label for="add-category">Add Category</label>
                  <input id="add-category" type="text" name="add-category" spellcheck="true" />
                  <input class="button" type="submit" name="submit" value="Add Category" />
                </form>
                <div class="form-messages"></div>
              </div>
            </div>
            <div class="col-sm-4">
              <!-- Comments -->
              <?php include_once($templates . "/comments.php"); ?>
            </div>
          </div>
        </div>
      </main>
    </div>
  </body>
</html>
