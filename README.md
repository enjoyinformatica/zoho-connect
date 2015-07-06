# Zoho Connect
Provê acesso as apis de integração dos produtos distribuídos pela [ZOHO](https://www.zoho.com)

**Pre-requisito:**
* PHP >= 5.3.3 necessário.

Utilização
---------------------
Segue instruções para utilização:

```php
<?php

$support = new \ZohoConnect\Scope\ZohoSupport("meutokendeautenticacaozoho");
$params = array(
    "portal" => "meuportal",
    'department' => "Meu Setor"
);
/*@var $response \Zend\Http\Response */
$response = $support->getRecords('requests', $params);

```
Lista de serviços disponiveis
-------------------------------------
**Zoho Support**
* ZohoSupport::getRecords
  - Informações https://www.zoho.com/support/help/get-records.html
* ZohoSupport::getRecordsById
  - Informações https://www.zoho.com/support/help/get-records-by-id.html
* ZohoSupport::searchRecords
  - Informações https://www.zoho.com/support/help/search-records.html
* ZohoSupport::addRecords
  - Informações https://www.zoho.com/support/help/add-records.html
* ZohoSupport::updateRecords
  - Informações https://www.zoho.com/support/help/update-records.html
* ZohoSupport::deleteRecords
  - Informações https://www.zoho.com/support/help/delete-records.html

**Nota**
* Até o momento este módulo trabalha somente com a api do produto ZohoSupport.