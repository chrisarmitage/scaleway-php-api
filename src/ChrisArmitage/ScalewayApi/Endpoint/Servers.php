<?php

namespace ChrisArmitage\ScalewayApi\Endpoint;

use ChrisArmitage\ScalewayApi\Client;
use ChrisArmitage\ScalewayApi\Domain\Server;
use ChrisArmitage\ScalewayApi\Domain\Task;
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
     * @param WebServiceGateway $gateway
     */
    public function __construct(WebServiceGateway $gateway) {
        $this->gateway = $gateway;
    }

    /**
     * @return Server[]
     * @throws \Exception
     */
    public function getAllServers() {
        $response = $this->gateway->getServers();

        $collection = [];

        foreach ($response->servers as $server) {
            $collection[] = Server::makeFromServerJson($server);
        }

        return $collection;
    }

    /**
     * @param $serverId
     * @return Server
     * @throws \Exception
     */
    public function getServer($serverId) {
        $response = $this->gateway->getServer($serverId);
        
        return Server::makeFromServerJson($response->server);
    }

    /**
     * @param $name
     * @param $organizationId
     * @param $imageId
     * @param $commercialType
     * @return Server
     * @throws \Exception
     */
    public function createServer($name, $organizationId, $imageId, $commercialType) {
        $response = $this->gateway->createServer($name, $organizationId, $imageId, $commercialType);

        return Server::makeFromServerJson($response->server);
    }

    /**
     * @param $serverId
     * @return mixed
     * @throws \Exception
     */
    public function deleteServer($serverId) {
        $response = $this->gateway->deleteServer($serverId);

        return $response;
    }

    /**
     * @param $serverId
     * @param $action
     * @return Task
     * @throws \Exception
     */
    public function setAction($serverId, $action) {
        $response = $this->gateway->setAction($serverId, $action);

        return Task::makeFromTaskJson($response->task);
    }
}
