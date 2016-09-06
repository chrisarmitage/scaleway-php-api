<?php

use ChrisArmitage\ScalewayApi\Domain\Image;
use ChrisArmitage\ScalewayApi\Domain\Ip;
use ChrisArmitage\ScalewayApi\Domain\Server;
use PHPUnit\Framework\TestCase;

/**
 * @covers ChrisArmitage\ScalewayApi\Domain\Server
 */
class ServerTest extends TestCase
{
    public function testMakesServerFromJson() {
        $json = json_decode(file_get_contents(__DIR__ . '/fixtures/server-running.json'));

        $server = Server::makeFromServerJson($json->server);

        self::assertEquals('00000000-0000-0000-0000-serverid0000', $server->getId());
        self::assertEquals('running', $server->getState());
        self::assertInstanceOf(Image::class, $server->getImage());
        self::assertInstanceOf(Ip::class, $server->getPublicIp());
        self::assertInstanceOf(Ip::class, $server->getPrivateIp());
        self::assertEquals('VC1S', $server->getCommercialType());
    }
}
