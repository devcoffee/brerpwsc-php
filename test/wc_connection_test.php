<?php

require "../src/BrerpWsc.php";

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




