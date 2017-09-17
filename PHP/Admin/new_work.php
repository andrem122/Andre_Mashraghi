<?php
//addresses
include_once($_SERVER["DOCUMENT_ROOT"] . "/Andre_Mashraghi/PHP/Includes/address.php");

//database
include_once($includes . "/work_db.php");

//kickout
require_once($includes . "/kickout.php");
?>
      <?php require_once($templates . "/head_admin.php"); ?>
        <div class="main-content-wrapper">
          <div class="center-content">
            <div class="post-center">
              <h2>Add New Work</h2>
              <form id="form-add-work" action="<?php echo htmlspecialchars("$form_scripts_uri/new_work.php", ENT_QUOTES, 'UTF-8', false); ?>" method="POST" enctype="multipart/form-data">

                <label for="work-link">Work Link</label>
                <input type="text" name="work_url" id="work-link" />

                <label for="image">Upload Image</label>
                <input type="file" name="fileToUpload" id="image" />

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
