<?php
//addresses
include_once($_SERVER["DOCUMENT_ROOT"] . "/Andre_Mashraghi/PHP/Includes/address.php");
//access the database
require_once($includes . "/blog_db.php");

//get the data for the post that was clicked on, and display it
$post_title = str_replace('-', ' ', $_GET['title']);

$urlPost_id = mysqli_real_escape_string($blog_db, $_GET['id']);
$post_title = mysqli_real_escape_string($blog_db, $post_title);

$_SESSION['post_title'] = str_replace('-', ' ', $post_title);
$_SESSION['post_id'] = $urlPost_id;

$sql = "SELECT posts_id, user_id, title, body, DATE_FORMAT(date_posted, '%M %e, %Y'),
image_url FROM posts WHERE posts_id=$urlPost_id AND title='$post_title'";
$result = mysqli_query($blog_db, $sql);

//failed call to database
if($result) {
  $num_rows = mysqli_num_rows($result);
  //check database for post info
  if($num_rows > 0) {
    $row = mysqli_fetch_assoc($result);

    $current_post_id = $row['posts_id'];
    $current_user_id = $row['user_id'];
    $current_title = $row['title'];
    $current_body =$row['body'];
    $current_date_posted = $row["DATE_FORMAT(date_posted, '%M %e, %Y')"];
    $image_url = $row['image_url'];

  } else {

    http_response_code(400);
    header("Location: $blogAdd");
    exit();

  }
} else {

  http_response_code(500);
  header("Location: $blogAdd");
  exit();

}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
      <?php
        echo htmlspecialchars($current_title, ENT_QUOTES, 'UTF-8', false);
      ?>
    </title>
    <link href="https://fonts.googleapis.com/css?family=Libre+Franklin:400,600" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($blogCss, ENT_QUOTES, 'UTF-8', false); ?>" />
    <script src="https://use.fontawesome.com/995faad108.js" defer></script>
    <!--JQuery-->
    <script
      src="https://code.jquery.com/jquery-3.2.1.min.js"
      integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
      crossorigin="anonymous">
    </script>
    <script src="<?php echo htmlspecialchars($viewpostJs, ENT_QUOTES, 'UTF-8', false); ?>" defer></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
  </head>
  <body class="viewpost">
    <div class="body-container">
      <div class="site-container">
        <?php
          include_once($templates . "/header.php");
        ?>
        <section class="article-featured-section">
          <div class="row">
            <div class="article-ft-fi" style="background-image: url('<?php echo htmlspecialchars($image_url, ENT_QUOTES, 'UTF-8', false); ?>')">
              <div class="center-content">
                  <div class="article-featured-text">
                    <h1 id="article-featured-title"><?php echo htmlspecialchars($current_title, ENT_QUOTES, 'UTF-8', false); ?></h1>
                    <span id="author">Andre Mashraghi | </span>
                    <span id="article-date"><?php echo htmlspecialchars($current_date_posted, ENT_QUOTES, 'UTF-8', false); ?></span>
                  </div>
              </div>
            </div>
          </div>
        </section>
        <section class="article-content">
          <div class="blog-center">
            <div class="article-body">
              <div class="center-content">
                <?php echo $current_body; ?>
              </div>
            </div>
            <!-- Comments -->
            <?php include_once($templates . "/comments.php"); ?>
            <!-- Comment Form -->
            <?php include_once($templates . "/comment-form.php"); ?>
          </div>
        </section>
        <!-- Recent Posts -->
        <?php include_once($templates . "/recent_posts.php"); ?>
        <!--Footer -->
        <?php include_once($templates . "/footer.php"); ?>
      </div>
    </div>
  </body>
</html>
