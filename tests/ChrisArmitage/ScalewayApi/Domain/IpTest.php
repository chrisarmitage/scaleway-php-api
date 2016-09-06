<?php

use ChrisArmitage\ScalewayApi\Domain\Ip;
use PHPUnit\Framework\TestCase;

/**
 * @covers ChrisArmitage\ScalewayApi\Domain\Ip
 */
class IpTest extends TestCase
{
    public function testMakesPublicIpFromJson() {
        $json = json_decode(file_get_contents(__DIR__ . '/fixtures/server-running.json'));

        $server = Ip::makeFromIpJson($json->server->public_ip);

        self::assertEquals('00000000-0000-0000-0000-publicipid00', $server->getId());
        self::assertEquals('163.172.111.222', $server->getAddress());
    }

    public function testMakesPrivateIpFromJson() {
        $json = json_decode(file_get_contents(__DIR__ . '/fixtures/server-running.json'));

        $server = Ip::makeFromIpAddress($json->server->private_ip);

        self::assertEquals(null, $server->getId());
        self::assertEquals('10.2.111.222', $server->getAddress());
    }
}
