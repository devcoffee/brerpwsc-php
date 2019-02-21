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

//Composer
use BrerpPhpCompositeWsc\BrerpWsc;

/*
require "../src/BrerpWsc.php";
*/

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