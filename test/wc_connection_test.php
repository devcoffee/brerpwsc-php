<?php

use BrerpPhpCompositeWsc\BrerpWsc;

$json_request = '
{
    "settings":{
       "urlEndpoint":"teste.brerp.com.br",
       "user":"superuser @ brerp.com.br",
       "password":"cafe123",
       "language":"en_US",
       "clientId":"1000000",
       "roleId":"1000000",
       "orgId":"5000003",
       "warehouseId":"5000007",
       "stage":"9"
    },
    "call":[
      {
         "type":"createUpdateData",
         "preCommit":"false",
         "postCommit":"false",
         "serviceName":"CreateBPartnerTest",
         "table":"c_bpartner",
         "action":"CreateUpdate",
         "name":"bpartner_id",
         "values":{
            "Name":"Chicão de Negócios",
            "email":"chicão@chicão.com",
            "TaxID":"",
            "IsVendor":"N",
            "IsCustomer":"Y",
            "IsTaxExempt":"N",
            "C_BP_Group_ID":"104"
         }
      }';



$brerpWsc = new BrerpWsc();
$brerpWsc->build_request($json_request);
$brerpWsc->make_request();


?>




