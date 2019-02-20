<?php

require "../src/BrerpWsc.php";

$request_content = file_get_contents("../documents/test_query_data.json");
$json_request = json_decode($request_content, true);
//echo $request_content;

$brerp_wsc = new BrerpWsc();

//Validando o formato JSON
$jsonValidate = $brerp_wsc->validate_JSON_request($json_request);

if($jsonValidate[0]){
    echo $jsonValidate[1];
} else {
    echo $jsonValidate[1];
    exit;
}

$brerp_wsc->build_request($json_request);

// $brerp_wsc->set_xml_request($xml);
echo "\n\n" . $brerp_wsc->get_xml_request();


$brerp_wsc->make_request();

//echo "\n\n\n" . $brerp_wsc->get_xml_response();
echo "\n\n\n" . $brerp_wsc->get_raw_json_response(); 
