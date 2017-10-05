<?php
$url = 'https://github.com/login/oauth/access_token';
  $data = array(
    'code'=>$_GET['code'],
  'client_secret'=>'a88c11d03ec5660db6b0df93c6f4ab1fd461ce90',
  'client_id'=>'1287d5c5d583fd5fd520'
);
$content = json_encode($data);

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
 curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
    // post_data
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
    if (!is_null($header)) {
        curl_setopt($curl, CURLOPT_HEADER, true);
    }
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
    curl_setopt($curl, CURLOPT_VERBOSE, true);
$json_response = curl_exec($curl);

$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
if ( $status != 200 ) {
    die("Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
}
curl_close($curl);
//echo $json_response;
$response = json_decode($json_response, true);
$token = $response['access_token'];
//Session::put("loginsession", $token);
session_start();
$_SESSION["loginsession"]= $token;
session_commit();
header('Location: https://api.github.com/user?access_token=' . $token);
 ?>
