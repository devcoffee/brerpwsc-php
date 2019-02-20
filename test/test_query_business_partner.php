<?php

require "../src/BrerpWsc.php";

$request_content = file_get_contents("../documents/test_query_data.json");
$json_request = json_decode($request_content);
//echo $request_content;

$xml = '
<soapenv:Envelope xmlns:_0="http://idempiere.org/ADInterface/1_0" 
    xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
    <soapenv:Header/>
    <soapenv:Body>
        <_0:queryData>
            <_0:ModelCRUDRequest>
                <_0:ModelCRUD>
                    <_0:serviceType>QueryBPartnerTest</_0:serviceType>
                    <_0:Limit>3</_0:Limit>
                    <_0:Offset>3</_0:Offset>
                    <_0:DataRow>
                        <_0:field column="Name">
                            <_0:val>%Store%</_0:val>
                        </_0:field>
                    </_0:DataRow>
                </_0:ModelCRUD>
                <_0:ADLoginRequest>
                    <_0:user>superuser @ brerp.com.br</_0:user>
                    <_0:pass>pp_brerp</_0:pass>
                    <_0:lang>pt_BR</_0:lang>
                    <_0:ClientID>1000000</_0:ClientID>
                    <_0:RoleID>1000000</_0:RoleID>
                    <_0:OrgID>5000003</_0:OrgID>
                    <_0:WarehouseID>5000007</_0:WarehouseID>
                    <_0:stage>9</_0:stage>
                </_0:ADLoginRequest>
            </_0:ModelCRUDRequest>
        </_0:queryData>
    </soapenv:Body>
</soapenv:Envelope>
';

$brerp_wsc = new BrerpWsc();

$brerp_wsc->build_request($request_content);
// $brerp_wsc->set_xml_request($xml);

echo "\n\n" . $brerp_wsc->get_json_request();
echo "\n\n" . $brerp_wsc->get_xml_request();


$brerp_wsc->make_request();

//echo "\n\n\n" . $brerp_wsc->get_xml_response();

echo "\n\n\n" . $brerp_wsc->get_raw_json_response(); 
