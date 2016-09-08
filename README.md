# scaleway-php-api
PHP client for interacting with the Scaleway API (https://developer.scaleway.com/)

## WARNING
Not production ready

## Basic usage

```php
use ChrisArmitage\ScalewayApi as Api;

$client = new Api\Client(new GuzzleHttp\Client(), 'https://api.scaleway.com/', 'youracce-ssto-ken0-0000-000000000000');
$gateway = new Api\WebService\Servers\WebServiceGateway($client);
$endpoint = new Api\Endpoints\Servers($gateway);

$server = $endpoint->createServer('server_name', 'organiza-tion-id00-0000-000000000000', 'imageid0-0000-0000-0000-000000000000', 'VC1S');
$task = $endpoint->setAction($server->getId(), 'poweron');
```
