<?php
//addresses
include_once($_SERVER["DOCUMENT_ROOT"] . "/Andre_Mashraghi/PHP/Includes/address.php");
//database
include_once($includes . "/users_db.php");
?>
<div class="center-content">
  <div id="comments" class="comments-area">
    <h2 class="comments-title">
      <?php
        if(isset($_SESSION['post_title']) && isset($_SESSION['post_id'])) {
          $post_title = mysqli_real_escape_string($users_db, $_SESSION['post_title']);
          $post_id    = mysqli_real_escape_string($users_db, $_SESSION['post_id']);
        }

        $path = htmlspecialchars($_SERVER["PHP_SELF"], ENT_QUOTES, 'UTF-8', false);
        $path_info = pathinfo($path);

        //check if we are on the admin page
        if($path_info['basename'] === 'index.php' && $path_info['dirname'] === '/Andre_Mashraghi/PHP/Admin') {
          $sql = "SELECT id, uid, comment, approved, post_title, DATE_FORMAT(date, '%M %d %Y, %l:%i %p'), date FROM comments";
        } else {
          $sql = "SELECT id, uid, comment, approved, DATE_FORMAT(date, '%M %d %Y, %l:%i %p'), date FROM comments WHERE post_id='$post_id' AND approved=1";
        }

        $result = mysqli_query($users_db, $sql);

        $num_rows = mysqli_num_rows($result);

        //check if query succeeds
        if($result) {
          if($num_rows > 0) {
            if($num_rows === 1) {
              echo htmlspecialchars($num_rows . ' Comment');
            } else {
              echo htmlspecialchars($num_rows .  ' Comments');
            }
          } else {
            echo htmlspecialchars('No Comments');
          }
        } else {
          http_response_code(500);
          echo htmlspecialchars('Error Loading Comments');
        }
      ?>
    </h2>
    <ol class="comment-list">
      <?php
      if($num_rows > 0):
        while($row = mysqli_fetch_assoc($result)):
        //only show comments when they are approved or on the admin page
      ?>
      <?php if($row['approved'] === '1' || $path_info['basename'] === 'index.php' && $path_info['dirname'] === '/Andre_Mashraghi/PHP/Admin'): ?>
      <li id="comment-<?php echo htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8', false); ?>" class="comment">
        <div class="text">
          <h5 class="name"><?php echo htmlspecialchars($row['uid'], ENT_QUOTES, 'UTF-8', false); ?></h5>
          <span class="comment-date">
            Posted on
            <time datetime="<?php echo htmlspecialchars($row['date'], ENT_QUOTES, 'UTF-8', false); ?>">
              <?php echo htmlspecialchars($row["DATE_FORMAT(date, '%M %d %Y, %l:%i %p')"], ENT_QUOTES, 'UTF-8', false); ?>
            </time>
            <?php
            if($path_info['basename'] === 'index.php' && $path_info['dirname'] === '/Andre_Mashraghi/PHP/Admin'):
              echo htmlspecialchars('in ' . $row['post_title']);
            endif;
            ?>
          </span>
          <div class="comment-content">
            <p><?php echo htmlspecialchars($row['comment'], ENT_QUOTES, 'UTF-8', false); ?></p>
          </div>
        </div>
        <?php if($path_info['basename'] === 'index.php' && $path_info['dirname'] === '/Andre_Mashraghi/PHP/Admin'):?>
        <div class="comment-options">
          <?php if($row['approved'] === '0'): ?>
          <button class="approve-comment">Approve</button>
          <?php else: ?>
          <button class="unapprove-comment">Unapprove</button>
          <?php endif; ?>
          <button class="trash-comment">Trash</button>
        </div>
        <?php endif; ?>
      </li>
      <?php endif; ?>
      <?php
        endwhile;
      endif;
      ?>
    </ol>
  </div>
</div>
