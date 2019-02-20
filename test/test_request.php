"""
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
"""
<?php

require "../src/BrerpWsc.php";

//Carregando json teste do diretório documentos
$request_content = file_get_contents("../documents/test_request.json");
$json_request = json_decode($request_content, true);

//Instanciando objeto BrerpWSC
$brerp_wsc = new BrerpWsc();

//Validando o formato JSON
$jsonValidate = $brerp_wsc->validate_JSON_request($json_request);

if($jsonValidate[0]){
    echo $jsonValidate[1];
} else {
    echo $jsonValidate[1];
    exit;
}

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