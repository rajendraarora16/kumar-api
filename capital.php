<?php


    $country = rawurlencode($_GET['countryName']);

    $countryName = ucfirst(strtolower($country));

    $data = file_get_contents('country.json', true);

    $json = json_decode($data, 1);
    

    for($i = 0; $i < count($json); $i++) {
        
        if($json[$i]["country"] === $countryName) {
            
            $myObj = array(
                'country' => $json[$i]["country"],
                'capital' => $json[$i]["capital"]
            );

            $jsonData = json_encode($myObj, true);

            echo '['.$jsonData.']';
        }
    }
    exit;
?>