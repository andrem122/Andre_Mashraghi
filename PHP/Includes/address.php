<?php
//start the session
if(!isset($_SESSION)) {
  session_start();
}
//default timezone
date_default_timezone_set('America/New_York');
//error reporting
error_reporting(-1);
ini_set('display_errors', 'On');
set_error_handler("var_dump");
//paths
//project folder
$host = 'http://' . $_SERVER['HTTP_HOST'];
$project = $_SERVER["DOCUMENT_ROOT"] . "/Andre_Mashraghi";
$projectUri = $host . '/Andre_Mashraghi';

//images
$images_uri = $projectUri . '/Assets/Images';
$images = $project . '/Assets/Images';

//includes
$includes = $project . "/PHP/Includes";
$includes_uri = $projectUri . "/PHP/Includes";

//webpages
$pages = $projectUri . "/PHP/Webpages";

//admin
$admin = "$host/admin";
$admin_index = "$admin/index";
$admin_blog_post = "$admin/blog-post";
$admin_work_post = "$admin/work-post";
$admin_delete = "$admin/delete";
$admin_logout = "$admin/logout";

//mail
$mail = $project . "/PHP/Mail";
$mailUri = $projectUri . "/PHP/Mail";

//form scripts
$form_scripts = $project . "/PHP/Form Scripts";
$form_scripts_uri = $projectUri . "/PHP/Form Scripts";

//templates
$templates = $project . "/PHP/Templates";

//javascript
$javascript = $projectUri . '/Javascript';

//css
$css = $projectUri . '/Stylesheets/CSS';

//nav bar addresses
$homeAdd = 'http://' . $_SERVER['HTTP_HOST'];
$workAdd = $homeAdd . '/#my-work';
$skillsAdd = $homeAdd . '/#my-skills';
$blogAdd = $homeAdd . '/blog';
$loginAdd = $homeAdd . '/login';
$creditsAdd = $homeAdd . '/credits';

//plugins
$plugins = "$javascript/Plugins";
$scrollTo = $javascript . '/Plugins/jquery.scrollTo.min.js';
$typed = $javascript . '/Plugins/typed.min.js';
$waypoints = $javascript . '/Plugins/jquery.waypoints.min.js';

//my scripts
$homeJs      = $javascript . '/script.js';
$blogPostsJs = $javascript . '/blog_posts.js';
$viewpostJs  = $javascript. '/viewpost.js';
$loginJs     = $javascript . '/login.js';

//my css
$homeCss = $css . '/Main_CSS/index.css';
$adminCss = $css . '/Admin/admin.css';
$blogCss = $css . '/Blog_CSS/blog.css';

//videos
$videos = $projectUri . '/Assets/Videos';
?>
