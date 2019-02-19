<?php

require "../src/BrerpWsc.php";

$request_content = file_get_contents("../documents/test_query_data.json");

//echo $request_content;

$brerp_wsc = new BrerpWsc();

$brerp_wsc->build_request($request_content);


echo "\n\n" . $brerp_wsc->get_json_request();
echo "\n\n" . $brerp_wsc->get_xml_request();

$brerp_wsc->make_request();

echo "\n\n\n" . $brerp_wsc->get_xml_response(); 
