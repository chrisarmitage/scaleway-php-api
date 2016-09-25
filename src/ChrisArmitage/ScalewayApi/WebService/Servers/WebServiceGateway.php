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
            $this->client->setResource('servers')
                ->setMethod('GET');
            $response = $this->client->call();
        } catch (\Exception $e) {
            throw new GeneralException('GetServers call failed', 0, $e);
        }

        return json_decode($response);
    }

    public function getServer($serverId) {
        try {
            $this->client->setResource("servers/{$serverId}")
                ->setMethod('GET');
            $response = $this->client->call();
        } catch (\Exception $e) {
            throw new GeneralException('GetServer call failed', 0, $e);
        }

        return json_decode($response);
    }

    public function createServer($name, $organizationId, $imageId, $commercialType) {
        try {
            $this->client->setResource('servers')
                ->setMethod('POST')
                ->setParameters(
                    [
                        'name'            => $name,
                        'organization'    => $organizationId,
                        'image'           => $imageId,
                        'commercial_type' => $commercialType,
                    ]
                );
            $response = $this->client->call();
        } catch (\Exception $e) {
            throw new GeneralException('CreateServer call failed', 0, $e);
        }

        return json_decode($response);
    }

    public function deleteServer($serverId) {
        try {
            $this->client->setResource("servers/{$serverId}")
                ->setMethod('DELETE');
            $response = $this->client->call();
        } catch (\Exception $e) {
            throw new GeneralException('DeleteServer call failed', 0, $e);
        }

        return json_decode($response);
    }

    public function setAction($serverId, $action) {
        try {
            $this->client->setResource("servers/{$serverId}/action")
                ->setMethod('POST')
                ->setParameters(
                    [
                        'action' => $action
                    ]
                );
            $response = $this->client->call();
        } catch (\Exception $e) {
            throw new GeneralException('SetAction call failed', 0, $e);
        }

        return json_decode($response);
    }

    public function getUserData($serverId, $key) {
        try {
            $this->client->setResource("servers/{$serverId}/user_data/{$key}")
                ->setMethod('GET');
            $response = $this->client->call();
        } catch (\Exception $e) {
            throw new GeneralException('GetUserData call failed', 0, $e);
        }

        return $response;
    }
}
