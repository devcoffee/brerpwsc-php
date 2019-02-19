<?php

require "../src/BrerpWsc.php";
require "../src/BinaryData.class.php";


//Lendo dados do arquivo json no diretorio documents
$request_content = file_get_contents("../documents/test_bpartner_image_create.json");
$json_request = json_decode($request_content, true);

//Atribuindo valor aleatório para a chave de busca do parceiro
$json_request["call"][1]["values"]["Value"] = random_int(1000000, 10000000);


//Convertendo logo para base64 e atribuindo no BinaryData
$binarydata = new BinaryData();
$imgb64 = $binarydata->img2base64("../images/logoP.png");

//Atribuindo o logo em base64 no BinaryData
$json_request["call"][0]["values"]["BinaryData"] = $imgb64;

//Instanciando o web service connector
$brerp_wsc = new BrerpWsc();

//Construindo requisição através do json
$brerp_wsc->build_request($json_request);
echo "\n". $brerp_wsc->get_json_request();

//Executando requisição e exibindo resposta
$brerp_wsc->make_request();
echo "\n\n" . $brerp_wsc->get_xml_response();


?>