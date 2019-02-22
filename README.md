# BrERP Web Service Connector - PHP

![logo-brerp](documents/logo_brerp-300x86.png)

O BrERP Web Service Connector tem como objetivo facilitar as requisições SOAP para os webservices do BrERP em sua aplicação **PHP**. Com sua arquitetura model oriented, não é necessário tratar os arquivos  XML de *request* e *response* **manualmente**. Desta forma, com o auxílio desta biblioteca, é possível realizar facilmente tarefas como:

- CRUDs, em qualquer tabela do sistema;
- Extrair informações de views;
- Executar Doc Actions em qualquer documento do BrERP;
- Executar processos.

## Compatibilidade

Este repositório conta com uma solução **PHP**, **compatível com PHP > 5.0**

## Arquitetura

O repositório está dividido em 3 diretórios:

- **brerpwsc**:
  - Este diretório contém o **código fonte** da biblioteca **brerpwsc**, que é compilada e inserida nos pacotes do **pip**;
- **test**:
  - Este diretório contém uma série de *arquivos de teste* e **arquivos de exemplo**, que podem ser utilizadas como base para a utilização dessa biblioteca em sua *aplicação PHP*.
- **documents**:
  - Este diretório contém arquivos utilizados pelos testes, como *xmls* e *JSONs* de exemplo, ou arquivos *.png*.

## Instalação

O **brerpwsc-php** está publicado como biblioteca no **Packagist**, e portanto, para utiliza-lo em seu projeto **php** basta instalá-lo utilizando o **composer**:

```shell
composer require devcoffee/brerp-php-composite-wsc
composer update
```

## Exemplo prático: Criando um Parceiro de Negócios com Imagem de Logo

Para podermos utilizar os webservices no **BrERP**, é necessário realizar uma configuração inicial, que deve informar o sistema sobre quais parâmetros esperar em um **request** e quais parâmetros enviar na **response**.
Neste exemplo, criaremos uma aplicação capaz de **Criar um parceiro de negócios com uma imagem de logo anexada**. Para isso, será necessário utilizar três *Web Services*, um para o envio da imagem, outro para a criação do parceiro de negócios, com o *record_id* da imagem referenciado e por fim, um **Web Service Composto** que nos permite enviar todas as informações em **uma única requisição**.

### Configurando os Webservices no BrERP

Para **exportar** ou **importar** dados no **BrERP**, *nenhuma linha de  código precisa ser escrita*. Basta que sejam feitas algumas simples configurações na janela de ***Segurança de Serviços Web***.

#### Segurança de Serviços Web

Esta é a janela de configuração dos Web Services, e possui 4 abas de configuração, sendo elas:

- **Parâmetros  de Serviço Web**:
  - Esta aba é de **importância vital** para o funcionamento do Web Service, uma vez que nela são configuradas as ações do Web Service, como a tabela a ser utilizada, a ação a ser realizada, entre outros.
- **Entradas de Serviço Web**:
  - Aqui é informado os parâmetros de entrada do Web Service, ou seja, quais informações serão consumidas por ele. É comum que os parâmetros sejam classificados em conformidade com os nomes da coluna da tabela manipulada.
- **Resultado de Serviço Web**:
  - Essa coluna diz respeito as informações que serão retornadas pelo Web Service, também tendo conformidade com o nome das colunas da tabela
- **Acesso de Serviço Web**:
  - Nessa aba são configuradas as permissões de Login do Web Service, ou seja, quais perfis terão permissão para utiliza-lo.

![SegurancaDeServicosWeb](/documents/SegurancaDeServicosWeb.png)

### Criando o Web Service CreateImageTest

Crie um novo WebService na janela **Segurança de Serviços Web** com o nome **CreateImageTest**, e preencha-o como a imagem abaixo. Atente-se para os parâmetros:

-**Serviço Web**: Deve ser **Model Oriented Web Services**, uma vez que o Web Service agirá diretamente com a base de dados.
-**Método de Serviço Web**: Deve ser **Create Data** uma vez que o Web Service irá inserir registros na base de dados.
-**Tabela**: Deve ser **AD_Image**

Lembre-se também de preencher os parâmetros da aba *Parâmetros de serviço Web* exatamente como na imagem:
![CreateImageTestWS](/documents/CreateImageTestWS.png)

Na aba **Entrada de Serviços Web** crie três campos, referentes as colunas que terão dados inseridos na tabela **AD_Image**:

![CreateImateTestWSEntrada](/documents/CreateImageTestWSEntrada.png)

Por fim, na aba **Acesso de Serviços Web** insira todos os usuários que devem ter permissão para utilizar o Web Service:

![CreateImageTestWSAcesso.png](/documents/CreateImageTestWSAcesso.png)

### Criando o Web Service CreateBPartnerTest

Crie um novo WebService na janela **Segurança de Serviços Web** com o nome **CreateBPartnerTest**, e preencha-o como a imagem abaixo. Atente-se para os parâmetros:

-**Serviço Web**: Deve ser **Model Oriented Web Services**, uma vez que o Web Service agirá diretamente com a base de dados.
-**Método de Serviço Web**: Deve ser **Create Data** uma vez que o Web Service irá inserir registros na base de dados.
-**Tabela**: Deve ser **C_BParter**

Lembre-se também de preencher os parâmetros da aba *Parâmetros de serviço Web* exatamente como na imagem:
![CreateImageTestWS](/documents/CreateBPartnertTestWS.png)

Na aba **Entrada de Serviços Web** crie três campos, referentes as colunas que terão dados inseridos na tabela **AD_Image**:

![CreateImateTestWSEntrada](/documents/CreateBPartnertTestWSEntrada.png)

Por fim, na aba **Acesso de Serviços Web** insira todos os usuários que devem ter permissão para utilizar o Web Service:

![CreateImageTestWSAcesso.png](/documents/CreateBPartnertTestAcesso.png)

### Criando o Web Service CompositeBPartnerTest

Crie um novo WebService na janela **Segurança de Serviços Web** com o nome **CompositeBPartnerTest**, e preencha-o como a imagem abaixo. Atente-se para os parâmetros:

-**Serviço Web**: Deve ser **CompositeInterface**, uma vez que o Web Service **não agirá** diretamente com a base de dados, mas sim, será como um coringa, encapsulando outros Web Services.

Lembre-se também de preencher os parâmetros da aba *Acesso de serviço Web* exatamente como na imagem:
![CreateImageTestWS](/documents/CompositeBPartnerTest.png)

### Código PHP

Com os WebServices criados, podemos utilizar o **brerpwsc-php** para realizar a interface entre a aplicação e os *Web Serives SOAP* do **BrERP**.
O **brerpwsc-php** utiliza arquivos **JSON** para montar os arquivos **XML** de requisição. Observe abaixo o exemplo de **JSON** para uma requisição do tipo **CompositeOperation**, para cadastrar uma imagem, a anexar seu ID no *Parceiro de Negócio*:

```JSON
{
    "settings":{
        //Informações de Login e sobre o Tipo do Web Service a ser consultado.
       "url":"https://teste.brerp.com.br",
       "user":"superuser @ brerp.com.br",
       "password":"sua_senha_aqui",
       "language":"pt_BR",
       "clientId":"1000000",
       "roleId":"1000000",
       "orgId":"5000003",
       "warehouseId":"5000007",
       "stage":"9",
       "serviceType": "CompositeOperation",
       "compositeWebServiceName": "CompositeWebServiceTest"
    },
    //Por ser do tipo CompositeOperation, a chave call é representada por uma lista, que contém as requisições individuais
    "call":[
        {
            //Requisição no WS CreateImageTest
            "type":"createData",
            "preCommit":"false",
            "postCommit":"false",
            "serviceName":"CreateImageTest",
            "table":"c_bpartner",
            "action":"Create",
            "name":"bpartner_id",
            "values":{
                "Name":"devCoffee-logo.png",
                "Description":"Test create a BPartner with a Logo",
                "BinaryData":"123456" //Campo a ser preenchido com o conteúdo da imagem em base64.
            }
        },
        {
            //Requisição no WS CreateBPartnetTest
            //Em operações do tipo Composite, o campo type é obrigatório
            "type":"createData",
            "preCommit":"false",
            "postCommit":"false",
            "serviceName":"CreateBPartnerTest",
            "table":"c_bpartner",
            "action":"Create",
            "name":"bpartner_id",
            "values":{
                "Name":"Parceiro de Negócios",
                "Value":"123456",
                "Logo_ID":"@AD_Image.AD_Image_ID"
            }
        }
    ]
 }
```

Podemos então, utilizar o seguinte código **PHP** para consultar o *Web Service*:

```php
<?php

require_once __DIR__ . '/vendor/autoload.php';

use DevCoffee\BrerpPhpCompositeWsc\BrerpWsc;
use DevCoffee\BrerpPhpCompositeWsc\BinaryData;


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
```

### XML de Envio ao servidor

```xml
<soapenv:Envelope xmlns:_0="http://idempiere.org/ADInterface/1_0" xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
  <soapenv:Header/>
  <soapenv:Body>
    <_0:compositeOperation>
      <_0:CompositeRequest>
        <_0:serviceType>CompositeBPartnerTest</_0:serviceType>
        <_0:operations>
          <_0:operation preCommit="false" postCommit="false">
            <_0:TargetPort>createData</_0:TargetPort>
            <_0:ModelCRUD>
              <_0:serviceType>CreateImageTest</_0:serviceType>
              <_0:DataRow>
                <_0:field column="Name">
                  <_0:val>brerp-logo.png</_0:val>
                </_0:field>
                <_0:field column="Description">
                  <_0:val>Test create a BPartner with a Logo</_0:val>
                </_0:field>
                <_0:field column="BinaryData">
                  <_0:val>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</_0:val>
                </_0:field>
              </_0:DataRow>
            </_0:ModelCRUD>
          </_0:operation>
          <_0:operation preCommit="false" postCommit="false">
            <_0:TargetPort>createData</_0:TargetPort>
            <_0:ModelCRUD>
              <_0:serviceType>CreateBPartnerTest</_0:serviceType>
              <_0:DataRow>
                <_0:field column="Name">
                  <_0:val>Parceiro de Negócios do BrERP</_0:val>
                </_0:field>
                <_0:field column="Value">
                  <_0:val>4074800</_0:val>
                </_0:field>
                <_0:field column="Logo_ID">
                  <_0:val>@AD_Image.AD_Image_ID</_0:val>
                </_0:field>
              </_0:DataRow>
            </_0:ModelCRUD>
          </_0:operation>
        </_0:operations>
        <_0:ADLoginRequest>
          <_0:user>superuser @ brerp.com.br</_0:user>
          <_0:pass>sua senha aqui</_0:pass>
          <_0:lang>en_US</_0:lang>
          <_0:ClientID>1000000</_0:ClientID>
          <_0:RoleID>1000000</_0:RoleID>
          <_0:OrgID>5000003</_0:OrgID>
          <_0:WarehouseID>5000007</_0:WarehouseID>
        </_0:ADLoginRequest>
      </_0:CompositeRequest>
    </_0:compositeOperation>
  </soapenv:Body>
</soapenv:Envelope>
```

### Resultado

A aplicação **PHP** utilizando a biblioteca **brerpwsc-php** construiu o .xml e enviou a requisição ao servidor do **BrERP**. Se observarmos a janela de **Parceiro de Negócios** podemos observar que o parceiro de negócios definido no código foi criado, juntamente com a imagem de logo escolhida:

![TestBPartnerCreated.png](/documents/TestBPartnerCreated.png)

## Realizando Requisições simples

Para realizar requisições simples, que apenas consultem um WebService por vez, o arquivo **JSON** sofre algumas alterações na sua forma. Observe um exemplo de requisição do tipo **queryData**:

```JSON
{
    "settings":{
       "url":"http://teste.brerp.com.br",
       "user":"superuser @ brerp.com.br",
       "password":"sua senha aqui",
       "language":"pt_BR",
       "clientId":"1000000",
       "roleId":"1000000",
       "orgId":"5000003",
       "warehouseId":"5000007",
       "stage":"9",
       //serviceType deve se referir ao serviço que será acessado
       "serviceType": "queryData"
    },
    //Por se tratar de uma requisição simples, a chave call é representada por um único dicionário.
    "call":
        {
            "preCommit":"false",
            "postCommit":"false",
            "serviceName":"QueryBPartnerTest",
            "table":"c_bpartner",
            "action":"queryData",
            "name":"bpartner_id",
            //queryConfig contém os parâmetros responsáveis pelos limites e inicío da busva
            "queryConfig":{
                //parâmetro que limita o retorno das informações
                "limit": 2,
                //Parâmetro que determina qual o índice inicial da busca.
                "offset": 0
            }
        }
 }
```

O código **PHP** mantém-se igual, apenas utilizando os objetos da classe **BrerpWsc**. O método **get_raw_json_response()** pode ser utilizado para exibir a resposta do servidor, já transformada em **JSON**.

```php
<?php

require_once __DIR__ . '/vendor/autoload.php';

use DevCoffee\BrerpPhpCompositeWsc\BrerpWsc;

$request_content = file_get_contents("../documents/test_query_data.json");
$json_request = json_decode($request_content, true);

$brerp_wsc = new BrerpWsc();

//Validando o formato JSON
$jsonValidate = $brerp_wsc->validate_JSON_request($json_request);

if($jsonValidate[0]){
    echo $jsonValidate[1];
} else {
    echo $jsonValidate[1];
    exit;
}

$brerp_wsc->build_request($json_request);

// $brerp_wsc->set_xml_request($xml);
echo "\n\n" . $brerp_wsc->get_xml_request();


$brerp_wsc->make_request();

//Exibindo resposta do servidor
echo "\n\n\n" . $brerp_wsc->get_raw_json_response(); 
```

### Resposta do Servidor

Com o envio acima, o servidor retornará  um **XML** contendo informações de **2 Parceiros de Negócio**, iniciando no **indice 0**. Esse **XML** é convertido para **JSON** e exibido na tela:

```JSON
{
    "soapBody": {
        "ns1queryDataResponse": {
            "WindowTabData": {
                "@attributes": {
                    "NumRows": "2",
                    "TotalRows": "80",
                    "StartRow": "0"
                },
                "DataSet": {
                    "DataRow": [
                        {
                            "field": [
                                {
                                    "@attributes": {
                                        "column": "C_BPartner_ID"
                                    },
                                    "val": "5000029"
                                },
                                {
                                    "@attributes": {
                                        "column": "Value"
                                    },
                                    "val": "0-00994786000100"
                                },
                                {
                                    "@attributes": {
                                        "column": "Name"
                                    },
                                    "val": "PARCEIRO DE NEGÓCIOS 1"
                                },
                                {
                                    "@attributes": {
                                        "column": "Logo_ID"
                                    },
                                    "val": {}
                                }
                            ]
                        },
                        {
                            "field": [
                                {
                                    "@attributes": {
                                        "column": "C_BPartner_ID"
                                    },
                                    "val": "5000031"
                                },
                                {
                                    "@attributes": {
                                        "column": "Value"
                                    },
                                    "val": "001-35019195812"
                                },
                                {
                                    "@attributes": {
                                        "column": "Name"
                                    },
                                    "val": "PARCEIRO DE NEGÓCIOS 2"
                                },
                                {
                                    "@attributes": {
                                        "column": "Logo_ID"
                                    },
                                    "val": {}
                                }
                            ]
                        }
                    ]
                },
                "RowCount": "2",
                "Success": "true"
            }
        }
    }
}
```
