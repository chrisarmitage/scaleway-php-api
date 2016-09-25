<?php

use ChrisArmitage\ScalewayApi\Client;
use ChrisArmitage\ScalewayApi\WebService\Servers\WebServiceGateway;
use Mockery as M;
use PHPUnit\Framework\TestCase;

class WebServiceGatewayTest extends TestCase
{
    public function tearDown()
    {
        parent::tearDown();
        M::close();
    }

    public function testReturnsResponseOnSuccessfulGetServersCall()
    {
        $gateway = new WebServiceGateway(
            $this->getMockClient(
                'GET',
                'servers',
                null
            )
        );

        $response = $gateway->getServers();

        self::assertEquals(true, $response->json);
    }

    /**
     * @param $method
     * @param $resource
     * @param $parameters
     * @return Client
     */
    protected function getMockClient($method, $resource, $parameters, $response = '{"json": true}') {
        $mockClient = M::mock(Client::class);
        $mockClient->shouldReceive('setResource')
            ->once()
            ->with($resource)
            ->andReturnSelf();
        $mockClient->shouldReceive('setMethod')
            ->once()
            ->with($method)
            ->andReturnSelf();
        if ($parameters !== null) {
            $mockClient->shouldReceive('setParameters')
                ->once()
                ->with($parameters)
                ->andReturnSelf();
        }
        $mockClient->shouldReceive('call')
            ->once()
            ->andReturn($response);

        return $mockClient;
    }

    /**
     * @expectedException ChrisArmitage\ScalewayApi\WebService\Servers\GeneralException
     */
    public function testThrowsExceptionOnFailedGetServersCall()
    {
        $gateway = new WebServiceGateway(
            $this->getMockExceptionClient(
                'GET',
                'servers',
                null,
                new \Exception()
            )
        );

        $gateway->getServers();
    }

    /**
     * @param $method
     * @param $resource
     * @param $parameters
     * @param Exception $exception
     * @return Client
     */
    protected function getMockExceptionClient($method, $resource, $parameters, \Exception $exception) {
        $mockClient = M::mock(Client::class);
        $mockClient->shouldReceive('setResource')
            ->once()
            ->with($resource)
            ->andReturnSelf();
        $mockClient->shouldReceive('setMethod')
            ->once()
            ->with($method)
            ->andReturnSelf();
        if ($parameters !== null) {
            $mockClient->shouldReceive('setParameters')
                ->once()
                ->with($parameters)
                ->andReturnSelf();
        }
        $mockClient->shouldReceive('call')
            ->once()
            ->andThrow($exception);

        return $mockClient;
    }

    public function testReturnsResponseOnSuccessfulGetServerCall()
    {
        $gateway = new WebServiceGateway(
            $this->getMockClient(
                'GET',
                'servers/serverId',
                null
            )
        );

        $response = $gateway->getServer('serverId');

        self::assertEquals(true, $response->json);
    }

    /**
     * @expectedException ChrisArmitage\ScalewayApi\WebService\Servers\GeneralException
     */
    public function testThrowsExceptionOnFailedGetServerCall()
    {
        $gateway = new WebServiceGateway(
            $this->getMockExceptionClient(
                'GET',
                'servers/serverId',
                null,
                new \Exception()
            )
        );

        $gateway->getServer('serverId');
    }

    public function testReturnsResponseOnSuccessfulCreateServerCall()
    {
        $gateway = new WebServiceGateway(
            $this->getMockClient(
                'POST',
                'servers',
                [
                    'name'            => 'serverName',
                    'organization'    => 'organizationId',
                    'image'           => 'imageId',
                    'commercial_type' => 'commercialType',
                ]
            )
        );

        $response = $gateway->createServer('serverName', 'organizationId', 'imageId', 'commercialType');

        self::assertEquals(true, $response->json);
    }

    /**
     * @expectedException ChrisArmitage\ScalewayApi\WebService\Servers\GeneralException
     */
    public function testThrowsExceptionOnFailedCreateServerCall()
    {
        $gateway = new WebServiceGateway(
            $this->getMockExceptionClient(
                'POST',
                'servers',
                [
                    'name'            => 'serverName',
                    'organization'    => 'organizationId',
                    'image'           => 'imageId',
                    'commercial_type' => 'commercialType',
                ],
                new \Exception()
            )
        );

        $gateway->createServer('serverName', 'organizationId', 'imageId', 'commercialType');
    }

    public function testReturnsResponseOnSuccessfulDeleteServerCall()
    {
        $gateway = new WebServiceGateway(
            $this->getMockClient(
                'DELETE',
                'servers/serverId',
                null
            )
        );

        $response = $gateway->deleteServer('serverId');

        self::assertEquals(true, $response->json);
    }

    /**
     * @expectedException ChrisArmitage\ScalewayApi\WebService\Servers\GeneralException
     */
    public function testThrowsExceptionOnFailedDeleteServerCall()
    {
        $gateway = new WebServiceGateway(
            $this->getMockExceptionClient(
                'DELETE',
                'servers/serverId',
                null,
                new \Exception()
            )
        );

        $response = $gateway->deleteServer('serverId');
    }

    public function testReturnsResponseOnSuccessfulSetActionCall()
    {
        $gateway = new WebServiceGateway(
            $this->getMockClient(
                'POST',
                'servers/serverId/action',
                [
                    'action' => 'actionName',
                ]
            )
        );

        $response = $gateway->setAction('serverId', 'actionName');

        self::assertEquals(true, $response->json);
    }

    /**
     * @expectedException ChrisArmitage\ScalewayApi\WebService\Servers\GeneralException
     */
    public function testThrowsExceptionOnFailedSetActionCall()
    {
        $gateway = new WebServiceGateway(
            $this->getMockExceptionClient(
                'POST',
                'servers/serverId/action',
                [
                    'action' => 'actionName',
                ],
                new \Exception()
            )
        );

        $gateway->setAction('serverId', 'actionName');
    }

    public function testReturnsResponseOnSuccessfulGetUserDataCall()
    {
        $gateway = new WebServiceGateway(
            $this->getMockClient(
                'GET',
                'servers/serverId/user_data/key',
                null,
                'KEY value'
            )
        );

        $response = $gateway->getUserData('serverId', 'key');

        self::assertEquals('KEY value', $response);
    }

    /**
     * @expectedException ChrisArmitage\ScalewayApi\WebService\Servers\GeneralException
     */
    public function testThrowsExceptionOnFailedGetUserDataCall()
    {
        $gateway = new WebServiceGateway(
            $this->getMockExceptionClient(
                'GET',
                'servers/serverId/user_data/key',
                null,
                new \Exception()
            )
        );

        $gateway->getUserData('serverId', 'key');
    }


}
