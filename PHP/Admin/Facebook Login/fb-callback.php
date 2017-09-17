<?php
if(!session_id() || !isset($_SESSION)) {
  session_start();
}
//addresses
include_once($_SERVER["DOCUMENT_ROOT"] . "/Andre_Mashraghi/PHP/Includes/address.php");
require_once __DIR__ . '/vendor/autoload.php';
require_once $includes . "/fb-creds.php";

$fb = new Facebook\Facebook([
'app_id' => $app_id, // Replace {app-id} with your app id
'app_secret' => $app_secret,
'default_graph_version' => 'v2.2',
]);

$helper = $fb->getRedirectLoginHelper();

try {
$accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
// When Graph returns an error
echo 'Graph returned an error: ' . $e->getMessage();
exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
// When validation fails or other local issues
echo 'Facebook SDK returned an error: ' . $e->getMessage();
exit;
}

if (! isset($accessToken)) {
if ($helper->getError()) {
  header('HTTP/1.0 401 Unauthorized');
  echo "Error: " . $helper->getError() . "\n";
  echo "Error Code: " . $helper->getErrorCode() . "\n";
  echo "Error Reason: " . $helper->getErrorReason() . "\n";
  echo "Error Description: " . $helper->getErrorDescription() . "\n";
} else {
  header('HTTP/1.0 400 Bad Request');
  echo 'Bad request';
}
exit;
}

// Logged in


// The OAuth 2.0 client handler helps us manage access tokens
$oAuth2Client = $fb->getOAuth2Client();

// Get the access token metadata from /debug_token
$tokenMetadata = $oAuth2Client->debugToken($accessToken);
// Validation (these will throw FacebookSDKException's when they fail)
$tokenMetadata->validateAppId($app_id); // Replace {app-id} with your app id
// If you know the user ID this access token belongs to, you can validate it here
//$tokenMetadata->validateUserId('123');
$tokenMetadata->validateExpiration();

if (! $accessToken->isLongLived()) {
// Exchanges a short-lived access token for a long-lived one
try {
  $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
} catch (Facebook\Exceptions\FacebookSDKException $e) {
  echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
  exit;
}

echo '<h3>Long-lived</h3>';
var_dump($accessToken->getValue());
}

$_SESSION['fb_access_token'] = (string) $accessToken;

try {
  // Returns a `Facebook\FacebookResponse` object
  $response = $fb->get('/me?fields=id,name,email', $accessToken);
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

$user = $response->getGraphUser();

$name = $_SESSION["name"] = $user->getName();
$id = $_SESSION["id"] = $user->getId();
$email = $_SESSION["email"] = $user->getEmail();
$_SESSION['uid'] = 'Andre Mashraghi';

if($name && $id && $email) {
  header("Location: $host" . "/admin/index");
} else {
  echo "Error: Something has went wrong. Try again.";
}
// User is logged in with a long-lived access token.
// You can redirect them to a members-only page.
//header('Location: https://example.com/members.php');
?>
