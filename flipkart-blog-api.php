<?php
header("Access-Control-Allow-Origin: *");

$url = 'https://tech.flipkart.com/?format=json';

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
$toSet[CURLOPT_FOLLOWLOCATION] = true;

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

$jsonDataWhile = stripslashes(html_entity_decode($return));

$jsonData = str_replace("])}while(1);</x>", "" ,$jsonDataWhile);
$decodeJsonData = json_decode($jsonData, true);

$globalArr = [];
$postsName = [];

$postsData = '';

$mainGlobal = [];

if( $decodeJsonData["success"] == 1 ) {

    $flipkartPostsId = $decodeJsonData["payload"]["collection"]["sections"][1]["postListMetadata"]["postIds"];

    $postsSection = $decodeJsonData["payload"]["references"]["Post"];
    $postedByUsers = $decodeJsonData["payload"]["references"]["User"];

    // print_r($decodeJsonData["payload"]["references"]["Post"]);exit;
    $num = 0;
    $num2 = 0;

    foreach($postsSection as $key => $postSec) {
        $globalArr[$num] = $postSec;
        $num++;
    }

    for($i=0; $i<count($postedByUsers); $i++) {

        // print_r($postedByUsers[$globalArr[$i]["creatorId"]]["name"]);
        // echo '[{"title" : "'+$globalArr[$i]["title"]+'"}]';
        // print_r($globalArr[$i]["title"] . " posted by " . $postedByUsers[$globalArr[$i]["creatorId"]]["name"]); 
        $mainGlobal[$i]["title"] = $globalArr[$i]["title"] . " posted by " . $postedByUsers[$globalArr[$i]["creatorId"]]["name"];
        $mainGlobal[$i]["url"] = "https://tech.flipkart.com/" . $globalArr[$i]["slug"] . "-" . $globalArr[$i]["id"];
                // "link" :  "https://we-are.bookmyshow.com/' . $globalArr[$i]["slug"] . "-" . $globalArr[$i]["id"] . '"'];
        // print_r("link: https://we-are.bookmyshow.com/" . $globalArr[$i]["slug"] . "-" . $globalArr[$i]["id"]);
        // print_r($globalArr);
    }

    $flipkartPostsJson = $mainGlobal;
    
    echo '[{ "response" : '; 
    echo '"<br/>';   
    foreach($flipkartPostsJson as $key => $value) {
    	$num2++;
        echo "<br/>".$num2.".) <a href='" . $value["url"] . "' target='_blank'>" . $value["title"] . "</a><br/>";
    }
    echo '"';   
    echo '}]';

}
?>