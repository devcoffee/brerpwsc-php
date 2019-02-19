<?php

require "../src/BrerpWsc.php";


//Lendo dados do arquivo json no diretorio documents
$request_content = file_get_contents("../documents/test_create_business_partner.json");
$json_request = json_decode($request_content, true);

//Atribuindo valor aleatório para a chave de busca do parceiro
$json_request["call"][0]["values"]["Value"] = random_int(1000000, 10000000);

//Instanciando o web service connector
$brerp_wsc = new BrerpWsc();

//Construindo requisição através do json
$brerp_wsc->build_request($json_request);
echo "\n". $brerp_wsc->get_json_request();

//Executando requisição e exibindo resposta
$brerp_wsc->make_request();
echo "\n\n" . $brerp_wsc->get_xml_response();

?>