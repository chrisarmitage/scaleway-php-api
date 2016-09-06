<?php

use ChrisArmitage\ScalewayApi\Domain\Image;
use PHPUnit\Framework\TestCase;

/**
 * @covers ChrisArmitage\ScalewayApi\Domain\Image
 */
class ImageTest extends TestCase
{
    public function testMakesImageFromJson() {
        $json = json_decode(file_get_contents(__DIR__ . '/fixtures/server-running.json'));

        $server = Image::makeFromImageJson($json->server->image);

        self::assertEquals('00000000-0000-0000-0000-imageid00000', $server->getId());
        self::assertEquals('CentOS 7 (beta)', $server->getName());
    }
}
