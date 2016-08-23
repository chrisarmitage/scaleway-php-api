<?php

namespace ChrisArmitage\ScalewayApi\WebService\Servers;

use ChrisArmitage\ScalewayApi\Client;

class WebServiceGateway
{
    /**
     * @var Client
     */
    protected $client;

    public function __construct(Client $client) {
        $this->client = $client;
    }

    public function getServers() {
        try {
            $this->client->setResource('servers');
            $response = $this->client->call();

        } catch (\Exception $e) {
            throw $e;
        }

        return $response;
    }

    public function getServer($serverId) {
        try {
            $this->client->setResource("servers/{$serverId}");
            $response = $this->client->call();

        } catch (\Exception $e) {
            throw $e;
        }

        return $response;
    }
}