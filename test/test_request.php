<?php

require "../src/BrerpWsc.php";

//Carregando json teste do diretório documentos
$request_content = file_get_contents("../documents/test_request.json");
$json_request = json_decode($request_content, true);

//Instanciando objeto BrerpWSC
$brerp_wsc = new BrerpWsc();

//Criando xml de envio
$brerp_wsc->build_request($json_request);


//exibe xml de envio (não formatada)
echo $brerp_wsc->get_xml_request();
echo "\n\n";

//Executa a requisição
$brerp_wsc->make_request();

//Exibe a resposta como json. No teste, o JSON deve estar vazio
echo $brerp_wsc->get_json_response();
echo "\n\n";

//Exibe a xml de resposta, também não formatada.
echo $brerp_wsc->get_xml_response();