<?php

use ChrisArmitage\ScalewayApi\Domain\Image;
use ChrisArmitage\ScalewayApi\Domain\Ip;
use ChrisArmitage\ScalewayApi\Domain\Server;
use PHPUnit\Framework\TestCase;

class ServerTest extends TestCase
{
    public function testMakesServerFromJson() {
        $json = json_decode(file_get_contents(__DIR__ . '/fixtures/server-booted.json'));

        $server = Server::makeFromServerJson($json->server);

        self::assertEquals('running', $server->getState());
        self::assertInstanceOf(Image::class, $server->getImage());
        self::assertInstanceOf(Ip::class, $server->getPublicIp());
        self::assertInstanceOf(Ip::class, $server->getPrivateIp());
        self::assertEquals('VC1S', $server->getCommercialType());
    }
}