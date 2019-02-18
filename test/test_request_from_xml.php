<?php

require "../src/BrerpWsc.php";

//Carregando parametros xml do arquivo teste no diretorio documentos
$xml_content = file_get_contents("../documents/test_request.xml");

//Instanciando o web service connector
$brerp_wsc = new BrerpWsc();
//Atribui o conteúdo do arquivo teste no atritubo xml_request.
//É ESPERADO QUE O XML DA REQUISIÇÃO ESTEJA COMPLETO PARA UTILIZAR ESSE MÉTODO
$brerp_wsc->set_xml_request($xml_content);

echo $brerp_wsc->get_xml_request();
echo "\n\n";

//Envia requisição e exibe a resposta
$brerp_wsc->make_request();
echo $brerp_wsc->get_json_response();