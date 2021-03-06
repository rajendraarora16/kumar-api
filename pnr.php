<?php
header("Access-Control-Allow-Origin: *");

$url = 'https://www.trainman.in/services/predictPnr?pnr='.rawurlencode($_GET['pnr']).'&key=012562ae-60a9-4fcd-84d6-f1354ee1ea48';

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

//sending cookies

// Load options
curl_setopt_array($curl, $toSet);


// Fetch page
$return = curl_exec($curl);

// Check for curl errors
if ( $error = curl_error($curl) ) 
 echo 'ERROR: ',$error;

// Close handle
curl_close($curl);

$jsonData = json_decode($return, true);
$RAC = false;

if( isset($jsonData["pnr_data"]["initial_passenger"]) ) {
	
	if( strpos($jsonData["pnr_data"]["initial_passenger"][0]["booking_status"], 'RAC') !== false) {
		$RAC = true;
	}


	//Confirmed
	if( isset($jsonData["pnr_data"]["initial_passenger"][0]["berth_type"]) ) {

		echo '[{ "result" : "Your seat is confirmed and seat number no. '.$jsonData["pnr_data"]["initial_passenger"][0]["booking_status"].' - '.$jsonData["pnr_data"]["initial_passenger"][0]["berth_type"].'" }]';exit;
	}
	

	//RAC
	else if($RAC) {
		echo '[{"result" : "Your seat is in RAC, current status - '.$jsonData["pnr_data"]["initial_passenger"][sizeof($jsonData["pnr_data"]["initial_passenger"])-1]["current_status"].'"}]';exit;
	}

	//Waiting list
	else {

		
		echo '[{"result" : "Your seat is in waiting listing, current status - '.$jsonData["pnr_data"]["initial_passenger"][sizeof($jsonData["pnr_data"]["initial_passenger"][0])-1]["current_status"].' and Booking status - '.$jsonData["pnr_data"]["initial_passenger"][sizeof($jsonData["pnr_data"]["initial_passenger"][0])-1]["booking_status"].'"}]';exit;
	}

}
else{
	echo '[{"result" : "Looks like your PNR no. is flushed or not confirmed!"}]';exit;
}

exit;
// if( isset($jsonData["pnr_data"]["initial_passenger"][0]["berth_type"]) ) {

// 	echo '[{ "result" : "Your seat is confirmed and seat number no. '.$jsonData["pnr_data"]["initial_passenger"][0]["booking_status"].' - '.$jsonData["pnr_data"]["initial_passenger"][0]["berth_type"].'" }]';
// }
// else if( isset($jsonData["pnr_data"][["initial_passenger"]) ) {
    
//     print_r("yes");
// }


// else{

// 	echo '[{"result" : "Looks like your PNR no. is flushed or not confirmed!"}]';
// }


// if($return["pnr_data"]) {
// 	print_r($return["pnr_data"]);	
// }
exit;
echo str_replace('\/','/', '['.$return.']');


?>