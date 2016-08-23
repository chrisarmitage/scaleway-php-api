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
}