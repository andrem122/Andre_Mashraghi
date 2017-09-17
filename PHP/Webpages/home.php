<?php
//addresses
include_once($_SERVER["DOCUMENT_ROOT"] . "/Andre_Mashraghi/PHP/Includes/address.php");
//access each database
include_once($includes . "/blog_db.php");
include_once($includes . "/work_db.php");
?>
<!DOCTYPE html>
<html class="b-h-overflow-hidden" lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Hey there! I&#039;m Andre Mashraghi. If you want to learn more about me and what I&#039;ve been up to, simply visit my website."/>
    <meta name="robots" content="noodp"/>
    <link rel="canonical" href="http://andremashraghi.com/" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Andre Mashraghi" />
    <meta property="og:description" content="Hey there! I&#039;m Andre Mashraghi. If you want to learn more about me and what I&#039;ve been up to, simply visit my website." />
    <meta property="og:url" content="http://andremashraghi.com/" />
    <meta property="og:site_name" content="Andre M." />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:description" content="Hey there! I&#039;m Andre Mashraghi. If you want to learn more about me and what I&#039;ve been up to, simply visit my website." />
    <meta name="twitter:title" content="Andre Mashraghi" />
    <title>Home</title>
    <link href="https://fonts.googleapis.com/css?family=Libre+Franklin:400,600" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="<?php echo htmlspecialchars($homeCss, ENT_QUOTES, 'UTF-8', false); ?>" />
    <script src="https://use.fontawesome.com/995faad108.js" defer></script>
    <!--JQuery-->
    <script
      src="https://code.jquery.com/jquery-3.2.1.min.js"
      integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
      crossorigin="anonymous">
    </script>
    <!--Scroll To-->
    <script src="<?php echo htmlspecialchars($scrollTo, ENT_QUOTES, 'UTF-8', false); ?>" defer></script>
    <!--Typed-->
    <script src="<?php echo htmlspecialchars($typed, ENT_QUOTES, 'UTF-8', false); ?>" defer></script>
    <!--Waypoints-->
    <script src="<?php echo htmlspecialchars($waypoints, ENT_QUOTES, 'UTF-8', false); ?>" defer></script>
    <!--Home Js-->
    <script src="<?php echo htmlspecialchars($homeJs, ENT_QUOTES, 'UTF-8', false); ?>" defer></script>
  </head>
  <body class="b-h-overflow-hidden home">
    <?php include_once("$templates/loader.php") ?>
    <div style="opacity: 0" class="body-container">
      <div class="main-content-wrapper">
        <section id="jumbotron">
          <div class="video-container">
            <video autoplay loop muted>
              <source src="<?php echo htmlspecialchars("$videos/Agua-natural.mp4", ENT_QUOTES, 'UTF-8', false); ?>" type="video/mp4" />
              <source src="<?php echo htmlspecialchars("$videos/Agua-natural.webm", ENT_QUOTES, 'UTF-8', false); ?>" type="video/webm" />
              Please update your browser or use Chrome, FireFox,
              or Safari to view this video.
            </video>
          </div>
          <?php
            include ($templates . "/scroll-header.php");
          ?>
          <div class="jumbo-content-wrap">
            <div class="center-content">
              <div id="typewriter">
                <h1></h1>
              </div>
              <div id="jumbo-desc">
                <p>Giving you the best of the web and more.</p>
                <a class="jumbo-btn" data-nav="#my-work" href="<?php echo htmlspecialchars($workAdd, ENT_QUOTES, 'UTF-8', false); ?>">My Work</a>
              </div>
            </div>
          </div>
        </section>
        <!-- My Work -->
        <section id="my-work">
          <div class="row">
            <div class="col-md-12 no-margin-bottom">
              <div class="section-text">
                <h1 class="section-heading">My Work</h1>
                <div class="section-p">
                  <p>
                    Wondering what I've worked on?
                    Get a feel for my work and take
                    a look at the examples below.
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 no-margin-bottom">
              <div class="section-content">
                <div class="work-cloud">
                  <?php
                    //grab data from work_examples table
                    $sql = "SELECT work_url, work_image_url FROM work_examples ORDER BY work_examples_id DESC LIMIT 6";
                    $result = mysqli_query($work_db, $sql);
                    //3 rows per page
                    $counter = 0;

                    echo '<div class="row">';
                    //echo data in work cloud div 12 times
                    while($row = mysqli_fetch_assoc($result)) {
                      echo ($counter++ % 3 == 0) ? '</div><div class="row">' : '';
                      $work_url = $row["work_url"];
                      $work_image_url = $row["work_image_url"];
                      echo "<div class='col-sm-4 marginless no-margin-bottom'><a target='_blank' style='background-image: url(\"$work_image_url\")' href='$work_url'></a></div>";
                    }

                    echo '</div>';
                  ?>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- Why Work? -->
        <section id="why-work">
          <div class="row">
            <div class="section-text">
              <h1 class="section-heading">Why Choose Me?</h1>
              <div class="section-p">
                <p>
                  Besides the fact that I'm awesome,
                  there are many other reasons why you
                  should definitely work with me! Here are
                  a few of the best reasons. Take a look below!
                </p>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="section-content" style="background-image: url('<?php echo htmlspecialchars("$images_uri/Sign%20Up/space_mountain.jpg", ENT_QUOTES, 'UTF-8', false); ?>')">
              <div class="row">
                <div class="col-md-4 marginless no-margin-bottom">
                  <div class="reason-wrap">
                    <div class="sec-title">
                      <h2>Professionalism</h2>
                    </div>
                    <div class="reason-text">
                      <p>
                        As a professional web developer,
                        I'll make sure you're taken care
                        of on time and treated with utmost
                        respect. I take pride in my work
                        and will only deliver the best.
                      </p>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 marginless no-margin-bottom">
                  <div class="reason-wrap">
                    <div class="sec-title">
                      <h2>Honesty</h2>
                    </div>
                    <div class="reason-text">
                      <p>
                        Honesty is one of my most important values.
                        Heck, sometimes I'm too honest. But all jokes
                        aside, I'll let you know every detail of every
                        project, and keep you informed.
                      </p>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 marginless no-margin-bottom">
                  <div class="reason-wrap">
                    <div class="sec-title">
                      <h2>Quality</h2>
                    </div>
                    <div class="reason-text">
                      <p>
                        I hate it just as much as you
                        do when work isn't of high quality.
                        That's why I give it my all and make
                        sure you're taken care of. It's my
                        reputation just as much as it is yours.
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- My Skills -->
        <section id="my-skills">
          <div class="row">
            <div class="section-text">
              <h1 class="section-heading">My Skills</h1>
              <div class="section-p">
                <p>
                  Aside from being ridiculously handsome,
                  I have many skills. A few of my best are
                  listed below for you to see. Take a look!
                </p>
              </div>
            </div>
          </div>
          <div class="row">
            <div id="skills-breakdown" class="section-content">
              <div class="center-content">
                <div id="skills-title" class="pri-title">
                  <h1>The Breakdown</h1>
                </div>
                <div class="row">
                  <div class="col-sm-6 no-margin-bottom">
                    <h3 class="h-skill-bar">Html</h3>
                    <div class="skill-bar-wrapper">
                      <div class="skill-bar">
                        <div class="skills-percentage" data-percentage="90%"></div>
                      </div>
                    </div>
                    <h3 class="h-skill-bar">CSS</h3>
                    <div class="skill-bar-wrapper">
                      <div class="skill-bar">
                        <div class="skills-percentage" data-percentage="86%"></div>
                      </div>
                    </div>
                    <h3 class="h-skill-bar">Javascript</h3>
                    <div class="skill-bar-wrapper">
                      <div class="skill-bar">
                        <div class="skills-percentage" data-percentage="46%"></div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <h3 class="h-skill-bar">jQuery</h3>
                    <div class="skill-bar-wrapper">
                      <div class="skill-bar">
                        <div class="skills-percentage" data-percentage="48%"></div>
                      </div>
                    </div>
                    <h3 class="h-skill-bar">Sass</h3>
                    <div class="skill-bar-wrapper">
                      <div class="skill-bar">
                        <div class="skills-percentage" data-percentage="75%"></div>
                      </div>
                    </div>
                    <h3 class="h-skill-bar">Ninja</h3>
                    <div class="skill-bar-wrapper">
                      <div class="skill-bar">
                        <div class="skills-percentage" data-percentage="86%"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- Social Media -->
        <section id="get-in-touch">
          <div class="row">
            <div class="section-text">
              <h1 class="section-heading">Get in Touch</h1>
              <div class="section-p">
                <p>
                  Have any questions or projects you want to discuss?
                  Let's get in touch via your preferred method below.
                </p>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="section-content">
              <div class="row">
                <div class="social-icons-wrapper">
                  <a class="icon-m-right" href="mailto:andre@andremashraghi.com?subject=Hey Andre, you're Awesome!&body=I'd like to tell you how awesome you are!"><i class="fa fa-envelope facebook" aria-hidden="true"></i></a>
                  <a class="icon-m-right" href="https://github.com/andrem122" target="_blank"><i class="fa fa-github github" aria-hidden="true"></i></a>
                  <a class="icon-m-right" href="https://plus.google.com/114591929050612006538" target="_blank"><i class="fa fa-google-plus g-plus" aria-hidden="true"></i></a>
                  <a href="https://www.linkedin.com/in/andre-mashraghi" target="_blank"><i class="fa fa-linkedin linkedin" aria-hidden="true"></i></a>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- Recent Posts -->
        <?php include_once($templates . "/recent_posts.php"); ?>
        <!--Footer -->
        <?php include_once($templates . "/footer.php"); ?>
        <!--Content Dock -->
        <?php include_once($templates . "/content-dock.php"); ?>
      </div>
    </div>
  </body>
</html>
