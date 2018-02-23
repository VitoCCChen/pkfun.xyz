<?PHP
require_once __DIR__ . '/vendor/autoload.php'; // change path as needed

$access_token = "EAAFtFl39JV4BAGYZCASd8K1bMzH3IRXvN8tBp7NIdRjUdINbZBkTaow2cX7nFVlaObBZCd0VZCd1nWrfZAiLSNBYdN4rCLwwsLzwg8VysugEoLbvLxFIG9VYot0yTfyo4c5ddVb8JalqLIr2ZCJ13StGMKwHbxSscafiaUtqtQ4capYDcE9SRCUgnfCDd2RidQsP6TbyQZCoQZDZD";
//"EAAFtFl39JV4BAHeZCU2R6A7l9iQ7D7ziGeroNDEllsZA31RYQIxThdpeFtJNYB78Lt0TgfQpjylDwDoT5mFybnPOnMPeE7wQZC0iP9A7JzVyqtV1JLE7JeCH01ZCzhjJDqBrBMqTAH1aJjCOWO1dHG6cn39ZBeCWGnL4CMIf8pBC6LKeX9uSCmveg0QDxmEmecr2eZBDbZACQZDZD";
$fb = new \Facebook\Facebook([
  'app_id' => '401417810290014',
  'app_secret' => '08ab9f4b3e74440a242015acc1c0b7d7',
  'default_graph_version' => 'v2.10',
  //'default_access_token' => '{access-token}', // optional
]);

// Use one of the helper classes to get a Facebook\Authentication\AccessToken entity.
//   $helper = $fb->getRedirectLoginHelper();
//   $helper = $fb->getJavaScriptHelper();
//   $helper = $fb->getCanvasHelper();
//   $helper = $fb->getPageTabHelper();

//$helper = $fb->getRedirectLoginHelper();

try {
  // Get the \Facebook\GraphNodes\GraphUser object for the current user.
  // If you provided a 'default_access_token', the '{access-token}' is optional.
  $response = $fb->get('/me', $access_token);
} catch(\Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(\Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

$me = $response->getGraphUser();
echo 'Name:' . $me->getName() .', ID:' .  $me->getId();
?>
