<?php
header("Access-Control-Allow-Origin: *");

$url = 'https://kumar-mind.herokuapp.com/kumar/chat.json?timezoneOffset='.rawurlencode($_GET['timezoneOffset']).'&q='.rawurlencode($_GET['q']);

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

echo str_replace('\/','/',$return);


?>