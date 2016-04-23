<?php
require_once __DIR__ . '/vendor/autoload.php';

if (!session_id()) {
    session_start();
}

$fb = new Facebook\Facebook([
  'app_id' => '999592210120857',
  'app_secret' => '8afa4740005e402867007621c737c303',
  'default_graph_version' => 'v2.5',
  'default_access_token' => '{access-token}', // optional
]);

// Use one of the helper classes to get a Facebook\Authentication\AccessToken entity.
   $helper = $fb->getRedirectLoginHelper();
//   $helper = $fb->getJavaScriptHelper();
//   $helper = $fb->getCanvasHelper();
//   $helper = $fb->getPageTabHelper();

$permissions = ['public_profile'];
$loginUrl = $helper->getLoginUrl('http://ytalk.org/facebook/facebook-callback.php', $permissions);


echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';

?>
