<?php

require "./src/Bulb.php";
require "./src/CurlRequest.php";

use PHPUnit\Framework\TestCase;

final class BulbTest extends TestCase
{
    public function testClassConstructor()
    {
        $bulb = new Bulb("user", "ip");
        $this->assertInstanceOf(Bulb::class, $bulb);
    }

    public function testChangeState()
    {
        $mockCurlRequest = $this->createMock(CurlRequest::class);
        $mockCurlRequest
            ->method("execute")
            ->willReturn('[{"success":{"/lights/id/state/on":true}}]');

        $bulb = new bulb($mockCurlRequest);
        $response = $bulb->changeState(true);
        echo $response;

        $this->assertEquals(
            $response,
            '[{"success":{"/lights/id/state/on":true}}]'
        );
    }
}
?>
