<?php

use ChrisArmitage\ScalewayApi\Client;
use GuzzleHttp\Client as GuzzleClient;
use Mockery as M;
use PHPUnit\Framework\TestCase;

/**
 * @covers ChrisArmitage\ScalewayApi\Client
 */
class ClientTest extends TestCase
{
    public function tearDown()
    {
        parent::tearDown();
        M::close();
    }

    public function testMakesGetCall()
    {
        $response = M::mock();
        $response->shouldReceive('getBody')
            ->andReturnSelf();
        $response->shouldReceive('getContents')
            ->andReturn('{"json": true}');

        $guzzle = M::mock(GuzzleClient::class)
            ->shouldReceive('get')
            ->with(
                'endpoint/resource',
                [
                    'headers' => [
                        'X-Auth-Token' => 'token',
                    ],
                ]
            )
            ->andReturn($response)
            ->getMock();

        $client = new Client($guzzle, 'endpoint', 'token');
        $client->setMethod('GET')
            ->setResource('/resource');

        $client->call();
    }

    public function testMakesPostCall()
    {
        $response = M::mock();
        $response->shouldReceive('getBody')
            ->andReturnSelf();
        $response->shouldReceive('getContents')
            ->andReturn('{"json": true}');

        $guzzle = M::mock(GuzzleClient::class)
            ->shouldReceive('post')
            ->with(
                'endpoint/resource',
                [
                    'headers' => [
                        'X-Auth-Token' => 'token',
                    ],
                    'json'    => [
                        'key' => 'value',
                    ],
                ]
            )
            ->andReturn($response)
            ->getMock();

        $client = new Client($guzzle, 'endpoint', 'token');
        $client->setMethod('POST')
            ->setResource('/resource')
            ->setParameters(['key' => 'value']);

        $client->call();
    }

    public function testMakesDeleteCall()
    {
        $response = M::mock();
        $response->shouldReceive('getBody')
            ->andReturnSelf();
        $response->shouldReceive('getContents')
            ->andReturn('{"json": true}');

        $guzzle = M::mock(GuzzleClient::class)
            ->shouldReceive('delete')
            ->with(
                'endpoint/resource',
                [
                    'headers' => [
                        'X-Auth-Token' => 'token',
                    ],
                ]
            )
            ->andReturn($response)
            ->getMock();

        $client = new Client($guzzle, 'endpoint', 'token');
        $client->setMethod('DELETE')
            ->setResource('/resource');

        $client->call();
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testThrowsExceptionIfNoMethodSet() {
        $guzzle = M::mock(GuzzleClient::class);

        $client = new Client($guzzle, 'endpoint', 'token');

        $client->call();
    }
}
