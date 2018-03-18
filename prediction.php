<?php
header("Access-Control-Allow-Origin: *");

$date = strtoupper(rawurldecode($_GET['date']));

if($date == '') {
	$date = date('d-m-Y');
	
	$url = 'https://www.trainman.in/services/cached-avl?ocode='.strtoupper(rawurldecode($_GET['from'])).'&dcode='.strtoupper(rawurldecode($_GET['to'])).'&quota=GN&date='.$date;

}else{ 


	$date_piece = explode(" ", $date);
	$dateNum = sprintf("%02d", $date_piece[0]);

	if(!isset($date_piece[1])) {
		$date_piece[1] = null;
	}
	if(!isset($date_piece[0])) {
		$date_piece[0] = null;
	}

	$dateMonth = (date_parse($date_piece[1])['month'] < 10 ? '0'.date_parse($date_piece[1])['month'] : date_parse($date_piece[1])['month']);


	$url = 'https://www.trainman.in/services/cached-avl?ocode='.strtoupper(rawurldecode($_GET['from'])).'&dcode='.strtoupper(rawurldecode($_GET['to'])).'&quota=GN&date='.$dateNum.'-'.$dateMonth.'-'.date('Y');
}



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

$jsonData = json_decode($return, true);

$trainChances = array();
$trainAvailable = array();
$kumarMessage = array();

$trainData = $jsonData["cached_avl"];

foreach ($trainData as $key => $value) {
	$num = 0;
	$num2 = 0;
	
	foreach ($value as $key2 => $value2) {
		# code...
		//$trainChances[$key][$key2] = $value2;
		
		foreach ($value2 as $key3 => $value3) {
			# code...

			$chancesNum = $value3[2][0][1]*100;

			if($chancesNum == 100) {
				
				$trainAvailable[$key][$num] = $key2;
				$num++;
			}

			else if( $chancesNum > 70 ) {

				$trainChances[$key][$num2] = $key2;
				$num2++;
			}
			// if((int)$value3[2][0][1]*100 > 70) {
			// 	print_r($value3[2][0][1]*100);
			// 	echo '<br>';
			// }
		}
	}
	
	# code...
	// $trainNumber[$key] = $value;
}

// $buyTicket = json_encode($trainNumber, true);

// foreach ($trainAvailable as $key => $value) {
// 	# code...
// 	$kumarText = "On ".rawurldecode($_GET['date']).", you can find availability on train no. ".$key;
// }
// print_r($trainAvailable);

// print_r($trainChances);
// exit;

/*train available message!*/
$trainAvailableMsg = '';
foreach ($trainAvailable as $key => $value) {
	# code...
	$trainAvailableMsg .= 'train no. '. $key . ' - ';
	// print_r(' ');
	foreach ($value as $key2 => $value2) {
		# code...
		$trainAvailableMsg .= $value2 . '-available, ';
	}
}

/*Waiting list message*/
$waitingListMsg = '';
foreach ($trainChances as $key => $value) {
	# code...
	$waitingListMsg .= 'train no. ' . $key . ' - ';
	// print_r($value);
	foreach ($value as $key2 => $value2) {
		# code...
		// print_r($value2);
		// print_r(' ');
		$waitingListMsg .= $value2 . ' waiting (Chances to clear), ';
	}
}

// echo $waitingListMsg;
// exit;

if( $trainAvailableMsg == '' ) {
	
	echo '{ "result" :[{"status" : "Currently there are no seats availabe but you can find waiting list trains and most probably chances to clear ' . $waitingListMsg . '" }]}';	
}

else if( $waitingListMsg == '' ) {

	echo '{ "result" :[{"status" : " Please find the available seats ' . $trainAvailableMsg . '" }]}';	
}

else if( $trainAvailableMsg == '' && $waitingListMsg == '' ){

	echo '{ "result" :[{"status" : "Currently there are no trains available as well all waiting list seats are closed, please plan for another date." }]}';		
}

else {
	
	echo '{ "result" :[{"status" : "Please find the available seats in ' . $trainAvailableMsg . '. Also you can find the waiting list train and chances are most probably to clear: ' . $waitingListMsg . '" }]}';	
}

exit;
?>