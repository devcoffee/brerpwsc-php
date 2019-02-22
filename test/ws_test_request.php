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

/*
require "../src/BrerpWsc.php";
*/

$json_request = '
{
   "settings":{
      "url":"http://teste.brerp.com.br",
      "user":"superuser @ brerp.com.br",
      "password":"sua senha aqui",
      "language":"en_US",
      "clientId":"1000000",
      "roleId":"1000000",
      "orgId":"5000003",
      "warehouseId":"5000007",
      "stage":"9"
   },
   "call":[
     {
        "type":"createData",
        "preCommit":"false",
        "postCommit":"false",
        "serviceName":"CreateBPartnerTest",
        "table":"c_bpartner",
        "action":"Create",
        "name":"bpartner_id",
        "values":{
           "Name":"Parceiro de Negócios",
           "Value":"123456"
        }
     }
   ]
}';


$brerpWsc = new BrerpWsc();
$brerpWsc->build_request($json_request);

echo $brerpWsc->get_json_request();
echo $brerpWsc->get_xml_request();

echo "\n\n\n\n\n\n\n\n\n\n";

$brerpWsc->make_request();
echo "\n\n\n\n\n\n\n\n\n\n";
echo $brerpWsc->get_xml_response();
echo "\n\n\n\n\n\n\n\n\n\n";
echo $brerpWsc->get_raw_json_response();
echo "\n\n\n";
echo $brerpWsc->get_json_response();
?>




