<?php

namespace ChrisArmitage\ScalewayApi\Endpoints;

use ChrisArmitage\ScalewayApi\Client;
use ChrisArmitage\ScalewayApi\Domain\Server;
use ChrisArmitage\ScalewayApi\WebService\Servers\WebServiceGateway;

class Servers
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @var WebServiceGateway
     */
    protected $gateway;

    /**
     * Servers constructor.
     * @param WebServiceGateway $gateway
     */
    public function __construct(WebServiceGateway $gateway) {
        $this->gateway = $gateway;
    }

    public function getAllServers() {
        $response = $this->gateway->getServers();

        $collection = [];

        foreach ($response->servers as $server) {
            $collection[] = Server::makeFromServerJson($server);
        }

        return $collection;
    }

    public function getServer($serverId) {
        $response = $this->gateway->getServer($serverId);
        
        return Server::makeFromServerJson($response->server);
    }

    public function createServer($name, $organizationId, $imageId, $commercialType) {
        $response = $this->gateway->createServer($name, $organizationId, $imageId, $commercialType);

        return Server::makeFromServerJson($response->server);
    }

    public function deleteServer($serverId) {
        $response = $this->gateway->deleteServer($serverId);

        return $response;
    }

    public function setAction($serverId, $action) {
        $response = $this->gateway->setAction($serverId, $action);

        return $response;
    }
}