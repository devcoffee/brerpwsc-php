<?php
/*
Produto: BrERP Web Service Client - PHP                                                   
Copyright (C) 2018  devCoffee Sistemas de Gestão Integrada                 
                                                                           
Este arquivo é parte do BrERP Web Service Client - PHP que é software livre; você pode     
redistribuí-lo e/ou modificá-lo sob os termos da Licença Pública Geral GNU,
conforme publicada pela Free Software Foundation; tanto a versão 3 da      
Licença como (a seu critério) qualquer versão mais nova.                   
                                                                           
                                                                           
Este programa é distribuído na expectativa de ser útil, mas SEM            
QUALQUER GARANTIA; sem mesmo a garantia implícita de                       
COMERCIALIZAÇÃO ou de ADEQUAÇÃO A QUALQUER PROPÓSITO EM                    
PARTICULAR. Consulte a Licença Pública Geral GNU para obter mais           
detalhes.                                                                  
                                                                           
Você deve ter recebido uma cópia da Licença Pública Geral GNU              
junto com este programa; se não, escreva para a Free Software              
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA                   
02111-1307, USA  ou para devCoffee Sistemas de Gestão Integrada,           
Rua Paulo Rebessi 665 - Cidade Jardim - Leme/SP - Brasil.                           
*/

//Composer
require_once __DIR__ . '/vendor/autoload.php';

use DevCoffee\BrerpPhpCompositeWsc\BrerpWsc;
use DevCoffee\BrerpPhpCompositeWsc\BinaryData;


/*
require "../src/BrerpWsc.php";
require "../src/BinaryData.class.php";
*/

//Lendo dados do arquivo json no diretorio documents
$request_content = file_get_contents("../documents/test_bpartner_image_create.json");
$json_request = json_decode($request_content, true);

//Instanciando o web service connector
$brerp_wsc = new BrerpWsc();


//Validando o formato JSON
$jsonValidate = $brerp_wsc->validate_JSON_request($json_request);

if($jsonValidate[0]){
    echo $jsonValidate[1];
} else {
    echo $jsonValidate[1];
    exit;
}

//Atribuindo valor aleatório para a chave de busca do parceiro
$json_request["call"][1]["values"]["Value"] = random_int(1000000, 10000000);


//Convertendo logo para base64 e atribuindo no BinaryData
$binarydata = new BinaryData();
$imgb64 = $binarydata->img2base64("../images/logoP.png");

//Atribuindo o logo em base64 no BinaryData
$json_request["call"][0]["values"]["BinaryData"] = $imgb64;



//Construindo requisição através do json
$brerp_wsc->build_request($json_request);
echo "\n". $brerp_wsc->get_json_request();

//Executando requisição e exibindo resposta
$brerp_wsc->make_request();
echo "\n\n" . $brerp_wsc->get_xml_response();


?>