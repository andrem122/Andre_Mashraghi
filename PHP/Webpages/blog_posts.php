<?php
  //addresses
  include_once($_SERVER["DOCUMENT_ROOT"] . "/Andre_Mashraghi/PHP/Includes/address.php");
  //database
  require_once($includes . "/blog_db.php");
  //get record count of posts in database
  $sql = "SELECT * FROM posts";
  $record_count = mysqli_query($blog_db, $sql);
  //amount of posts displayed on one page at a time
  $posts_per_page = 9;
  //number of pages
  $num_pages = ceil($record_count->num_rows / $posts_per_page);
  if(isset($_GET["p"]) && is_numeric($_GET["p"])) {
    //the current page number stored in a variable
    $page = $_GET["p"];
  }
  else {
    //if the page number variable is NOT set AND is NOT a number, set it equal to 1
    $page = 1;
  }

  if($page <= 0) {
    $start = 0;
  }
  else {
    $start = ($page * $posts_per_page) - $posts_per_page;
  }
  //next and prev
  $prev = $page - 1;
  $next = $page + 1;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Check out Andre Mashraghi&#039;s blog to learn more about him and what he does."/>
    <meta name="robots" content="noodp"/>
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="The Blog" />
    <meta property="og:description" content="Check out Andre Mashraghi&#039;s blog to learn more about him and what he does." />
    <meta property="og:site_name" content="Andre M." />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:description" content="Check out Andre Mashraghi&#039;s blog to learn more about him and what he does." />
    <meta name="twitter:title" content="The Blog" />
    <title>The Blog</title>
    <link href="https://fonts.googleapis.com/css?family=Libre+Franklin:400,600" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($blogCss, ENT_QUOTES, 'UTF-8', false); ?>" />
    <script src="https://use.fontawesome.com/995faad108.js" defer></script>
    <!--JQuery-->
    <script
      src="https://code.jquery.com/jquery-3.2.1.min.js"
      integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
      crossorigin="anonymous">
    </script>
    <script src="<?php echo htmlspecialchars($blogPostsJs, ENT_QUOTES, 'UTF-8', false); ?>" defer></script>
  </head>
  <body class="blog">
    <div class="body-container">
      <div class="site-container">
        <?php
          include($templates . "/header.php");
        ?>
        <section id="blog-intro">
          <div class="row">
            <div class="blog-intro-wrap">
              <div class="center-content">
                <div class="blog-intro-text">
                  <h1 class="blog-intro-title">The Blog</h1>
                  <p>
                    Welcome to my little corner of the internet.
                    Kick up your feet and stay a while.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </section>
        <section class="blog-posts">
          <div class="center-content">
            <div class="row">
              <?php
                //have 3 rows with 3 posts in each row: total posts_per_page = 9
                $store = "DATE_FORMAT(date_posted, '%M %e, %Y')";
                $sql =
                "SELECT posts.posts_id, posts.title, DATE_FORMAT(posts.date_posted, '%M %e, %Y'), posts.image_url, LEFT(posts.body, 250), categories.category
                FROM posts
                INNER JOIN categories ON posts.category_id=categories.category_id ORDER BY posts_id DESC LIMIT $start, $posts_per_page";
                $result = mysqli_query($blog_db, $sql);
                //3 rows per page
                $counter = 0;

                echo '<div class="row">';
                while($row = mysqli_fetch_assoc($result)) {
                  echo ($counter++ % 3 == 0) ? '</div><div class="row">' : '';
                  //store table results in variables
                  $post_id = strip_tags($row["posts_id"]);
                  $title = strip_tags($row["title"]);
                  $cat = strip_tags($row["category"]);
                  $summary = html_entity_decode($row["LEFT(posts.body, 250)"]);
                  $summary = strip_tags($summary) . "...";
                  $titleURL = rawurlencode($title); //encode the title in a compatible url format so it can be typed in the address bar
                  $titleURL = str_replace('%20', '-', $titleURL);
                  $date = strip_tags($row["DATE_FORMAT(posts.date_posted, '%M %e, %Y')"]);
                  $image_url = strip_tags($row["image_url"]);
                  $path = "$blogAdd/" . "$post_id/" . $titleURL; //use absolute path to prevent confusion with browser
                  echo
                  "<div class='col-md-4'>
                    <article class='blog-post'>
                      <a href='$path' title='$title' class='blog-post-top'>
                        <i class='fa fa-newspaper-o' aria-hidden='true'></i>
                        <div class='blog-post-img' style='background-image: url(\"$image_url\")'></div>
                      </a>
                      <div class='blog-post-bottom'>
                        <a href='$path' title='$title'><h3>$title</h3></a>
                        <span>Posted on $date in $cat</span>
                        <p>$summary</p>
                        <a title='$title' href='$path' class='button'>Read More</a>
                      </div>
                    </article>
                  </div>";
                }
                echo '</div>';
              ?>
            </div>
              <?php
                //use absolute path to prevent confusion with browser
                $pathP = $host . "/blog/page-" . $prev;
                $pathN = $host . "/blog/page-" . $next;
                if($prev > 0 || $page < $num_pages) {
                  echo "<div class='row'>";
                  echo "<div class='navigation-btns'>";
                  if($prev > 0) {
                    echo "<a class='navigation-btn prev' href='$pathP'><i class='fa fa-angle-left' aria-hidden='true'></i>Previous Page</a>";
                  }
                  if ($page < $num_pages) {
                    echo "<a class='navigation-btn next' href='$pathN'>Next Page<i class='fa fa-angle-right icon-m-left' aria-hidden='true'></i></a>";
                  }
                  echo "</div>";
                  echo "</div>";
                }
              ?>
          </div>
        </section>
        <footer>
          <?php include_once($templates . "/footer.php"); ?>
        </footer>
      </div>
    </div>
  </body>
</html>
