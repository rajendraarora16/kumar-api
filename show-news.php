<?php
header("Access-Control-Allow-Origin: *");

$country = '';

if(!isset($_GET['country']) || $_GET['country'] == ''){
	$country = 'in';
}
else if(rawurldecode($_GET['country']) == 'india') {
	$country = 'in';
}
else if(rawurldecode($_GET['country']) == 'usa' || rawurldecode($_GET['country']) == 'america' || rawurldecode($_GET['country']) == 'los angeles' || rawurldecode($_GET['country']) == 'united states' || rawurldecode($_GET['country']) == 'united states of america' || rawurldecode($_GET['country']) == 'world' || rawurldecode($_GET['country']) == 'world news') {
	$country = 'us';
}
else if(rawurldecode($_GET['country']) == 'united arab emirates' || rawurldecode($_GET['country']) == 'dubai' || rawurldecode($_GET['country']) == 'abu dhabi' || rawurldecode($_GET['country']) == 'abu dhabi') {
	$country = 'ae';
}
else if(rawurldecode($_GET['country']) == 'saudi arabia') {
	$country = 'sa';
}
elseif (rawurldecode($_GET['country']) == 'Argentina') {
	# code...
	$country = 'ar';
}
elseif (rawurldecode($_GET['country']) == 'Armenia') {
	# code...
	$country = 'am';
}elseif(rawurldecode($_GET['country']) == 'germany' || rawurldecode($_GET['country']) == 'berlin'){ 
	$country='de';
}else {
	$country = 'in';
}

// print_r($country);exit;
$url = 'https://newsapi.org/v2/top-headlines?country='.$country.'&apiKey=5d35a0deee7e4a219ea6934ef8090040';

// Display errors
ini_set('display_errors',1);
header('Content-Type:application/json; charset=utf-8');
// Set up options
$toSet[CURLOPT_CONNECTTIMEOUT] = 20; // Time to wait for connection
$toSet[CURLOPT_TIMEOUT] = 45; // Time to wait for whole operation
$toSet[CURLOPT_RETURNTRANSFER] = true; // Return transfer instead of printing
$toSet[CURLOPT_FAILONERROR] = true;

// Forward the custom headers
if ( isset($_SERVER['HTTP_USER_AGENT']) ) $toSet[CURLOPT_USERAGENT] = $_SERVER['HTTP_USER_AGENT'];

// Show SSL without verifying
$toSet[CURLOPT_SSL_VERIFYPEER] = false;
$toSet[CURLOPT_SSL_VERIFYHOST] = false;

// Start curl
$curl = curl_init($url);

// Load options
curl_setopt_array($curl, $toSet);

// Fetch page
$return = curl_exec($curl);

// Check for curl errors
if ( $error = curl_error($curl) ) 
 echo 'ERROR: ',$error;

// Close handle
curl_close($curl);

$newsJson = json_decode($return, true);

$arrayJson = $newsJson["articles"];

$one_item = $arrayJson[rand(0, count($arrayJson) - 1)];

$one_item_string = json_encode($one_item);

echo '['.$one_item_string.']';
exit;


?>