<?php

use ChrisArmitage\ScalewayApi\Domain\Server;
use ChrisArmitage\ScalewayApi\Domain\Task;
use ChrisArmitage\ScalewayApi\Endpoint\Servers;
use ChrisArmitage\ScalewayApi\WebService\Servers\WebServiceGateway;
use Mockery as M;
use PHPUnit\Framework\TestCase;

/**
 * @covers ChrisArmitage\ScalewayApi\Endpoint\Servers
 */
class ServersTest extends TestCase
{
    public function tearDown()
    {
        parent::tearDown();
        M::close();
    }

    public function testGetServersReturnsAnArrayContainingServers()
    {
        $gateway = M::mock(WebServiceGateway::class)
            ->shouldReceive('getServers')
            ->once()
            ->andReturn(json_decode(file_get_contents(__DIR__ . '/../Domain/fixtures/servers.json')))
            ->getMock();

        $endpoint = new Servers($gateway);

        $collection = $endpoint->getAllServers();

        self::assertCount(2, $collection);
        self::assertContainsOnlyInstancesOf(Server::class, $collection);
    }

    public function testGetServerReturnsServer()
    {
        $gateway = M::mock(WebServiceGateway::class)
            ->shouldReceive('getServer')
            ->once()
            ->with('00000000-0000-0000-0000-serverid0000')
            ->andReturn(json_decode(file_get_contents(__DIR__ . '/../Domain/fixtures/server-running.json')))
            ->getMock();

        $endpoint = new Servers($gateway);

        $collection = $endpoint->getServer('00000000-0000-0000-0000-serverid0000');

        self::assertInstanceOf(Server::class, $collection);
    }

    public function testCreateServerReturnsServer()
    {
        $gateway = M::mock(WebServiceGateway::class)
            ->shouldReceive('createServer')
            ->once()
            ->with('name', '00000000-0000-0000-0000-organization', '00000000-0000-0000-0000-imageid00000', 'type')
            ->andReturn(json_decode(file_get_contents(__DIR__ . '/../Domain/fixtures/server-running.json')))
            ->getMock();

        $endpoint = new Servers($gateway);

        $collection = $endpoint->createServer('name', '00000000-0000-0000-0000-organization', '00000000-0000-0000-0000-imageid00000', 'type');

        self::assertInstanceOf(Server::class, $collection);
    }

    public function testSetActionReturnsTask()
    {
        $gateway = M::mock(WebServiceGateway::class)
            ->shouldReceive('setAction')
            ->once()
            ->with('00000000-0000-0000-0000-serverid0000', 'action')
            ->andReturn(json_decode(file_get_contents(__DIR__ . '/../Domain/fixtures/task-pending.json')))
            ->getMock();

        $endpoint = new Servers($gateway);

        $collection = $endpoint->setAction('00000000-0000-0000-0000-serverid0000', 'action');

        self::assertInstanceOf(Task::class, $collection);
    }

    public function testGetUserDataReturnsAString() {
        $gateway = M::mock(WebServiceGateway::class)
            ->shouldReceive('getUserData')
            ->once()
            ->with('00000000-0000-0000-0000-serverid0000', 'key')
            ->andReturn('KEY value')
            ->getMock();

        $endpoint = new Servers($gateway);

        $userData = $endpoint->getUserData('00000000-0000-0000-0000-serverid0000', 'key');

        self::assertTrue(is_string($userData));
    }
}
