<?php

  //access the blog database
  include_once($includes . "/blog_db.php");

  $sql = "SELECT * FROM posts";
  $result = mysqli_query($blog_db, $sql);
  $num_rows = mysqli_num_rows($result);

  //grab latest posts from posts table and order by latest post
  $sql =
  "SELECT posts.posts_id, posts.title, DATE_FORMAT(posts.date_posted, '%M %e, %Y'), posts.image_url, categories.category
  FROM posts
  INNER JOIN categories ON posts.category_id=categories.category_id ORDER BY posts_id DESC LIMIT 3";
  $result = mysqli_query($blog_db, $sql);

  //if there is at least one row with post info in our table, then echo out the posts section
  if($num_rows > 0) {
    echo
    '<section id="recent-posts">
      <div class="center-content">
        <div class="row">
          <div><h2 class="pri-title">Recent Posts</h2></div>';

    while($row = mysqli_fetch_assoc($result)) {

      //store data in variables
      $post_id = $row["posts_id"];
      $title = $row["title"];
      $titleURL = rawurlencode($title); //encode the title in a compatible url format so it can be typed in the address bar
      $titleURL = str_replace('%20', '-', $titleURL);
      $date = $row["DATE_FORMAT(posts.date_posted, '%M %e, %Y')"];
      $cat = $row["category"];
      $image_url = $row["image_url"];
      $path = "$blogAdd/$post_id/$titleURL";

        echo
        "
        <div class='col-md-4'>
          <article class='recent-post'>
            <a href='$path' title='$title' class='recent-post-top'>
              <i class='fa fa-newspaper-o' aria-hidden='true'></i>
              <div class='recent-post-img' style='background-image: url(\"$image_url\")'></div>
            </a>
            <div class='recent-post-bottom'>
              <a href='$path' title='$title'><h3>$title</h3></a>
              <span>$date | $cat</span>
            </div>
          </article>
        </div>
        ";
    }
    echo '</div>
        </div>
      </section>';
  }
?>
