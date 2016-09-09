# scaleway-php-api
PHP client for interacting with the Scaleway API (https://developer.scaleway.com/)

[![Build Status](https://scrutinizer-ci.com/g/chrisarmitage/scaleway-php-api/badges/build.png?b=master)](https://scrutinizer-ci.com/g/chrisarmitage/scaleway-php-api/build-status/master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/chrisarmitage/scaleway-php-api/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/chrisarmitage/scaleway-php-api/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/chrisarmitage/scaleway-php-api/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/chrisarmitage/scaleway-php-api/?branch=master)

## WARNING
Not production ready

## Current status
* Offers enough functionality to create and poweron VC1S servers.
* No support for volumes yet.
* No tested on other server types yet.
* No validation on parameters (Scaleway docs are a little lightweight).

## Roadmap
* Make a Roadmap...

## Basic usage

```php
use ChrisArmitage\ScalewayApi as Api;

$client = new Api\Client(new GuzzleHttp\Client(), 'https://api.scaleway.com/', 'youracce-ssto-ken0-0000-000000000000');
$gateway = new Api\WebService\Servers\WebServiceGateway($client);
$endpoint = new Api\Endpoint\Servers($gateway);

$server = $endpoint->createServer('server_name', 'organiza-tion-id00-0000-000000000000', 'imageid0-0000-0000-0000-000000000000', 'VC1S');
$task = $endpoint->setAction($server->getId(), 'poweron');
```

## With Auryn (dependency injection)

```php
use ChrisArmitage\ScalewayApi as Api;

$container = new Auryn\Injector();

$container->define(
    Api\Client::class,
    [
        ':endpoint' => 'https://api.scaleway.com/',
        ':token' => 'youracce-ssto-ken0-0000-000000000000'
    ]
);
$endpoint = $container->make(Api\Endpoint\Servers::class);

$server = $endpoint->createServer('server_name', 'organiza-tion-id00-0000-000000000000', 'imageid0-0000-0000-0000-000000000000', 'VC1S');
$task = $endpoint->setAction($server->getId(), 'poweron');
```
