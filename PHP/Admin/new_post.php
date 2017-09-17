<?php
//addresses
include_once($_SERVER["DOCUMENT_ROOT"] . "/Andre_Mashraghi/PHP/Includes/address.php");

//database
include_once($includes . "/blog_db.php");

//require the kickout
require_once($includes . "/kickout.php");
?>
      <?php require_once($templates . "/head_admin.php"); ?>
        <div class="main-content-wrapper">
          <div class="center-content">
            <div class="post-center">
              <h2>Create a New Post</h2>
              <form id="form-new-post" action="<?php echo htmlspecialchars("$form_scripts_uri/new_post.php", ENT_QUOTES, 'UTF-8', false); ?>" method="POST" enctype="multipart/form-data">

                <label for="title">Title</label>
                <input type="text" name="title" id="title" />

                <label for="body">Body</label>
                <textarea cols="50" rows="10" id="body" name="body"></textarea>

                <label for="image">Upload Image</label>
                <input type="file" name="fileToUpload" id="image" />

                <label for="categories">Category</label>
                <select name="category" id="categories">
                  <?php
                  $sql = "SELECT category_id, category FROM categories";
                  $result = mysqli_query($blog_db, $sql);

                  while($row = mysqli_fetch_assoc($result)): ?>

                  <option value="<?php echo htmlspecialchars($row['category_id'], ENT_QUOTES, 'UTF-8', false); ?>"><?php echo htmlspecialchars($row['category'], ENT_QUOTES, 'UTF-8', false); ?></option>

                  <?php endwhile; ?>
                </select>
                <input class="button" type="submit" value="Post" name="submit" />
              </form>
              <div class="form-messages"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
