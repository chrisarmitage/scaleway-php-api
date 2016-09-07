<?php

use ChrisArmitage\ScalewayApi\Client;
use ChrisArmitage\ScalewayApi\WebService\Servers\GeneralException;
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

        self::assertEquals('{json: true}', $response);
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

        self::assertEquals('{json: true}', $response);
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

        self::assertEquals('{json: true}', $response);
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

        self::assertEquals('{json: true}', $response);
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

        self::assertEquals('{json: true}', $response);
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

    protected function getMockClient($method, $resource, $parameters)
    {
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
            ->andReturn('{json: true}');

        return $mockClient;
    }

    protected function getMockExceptionClient($method, $resource, $parameters, \Exception $exception)
    {
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


}
