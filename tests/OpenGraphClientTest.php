<?php

use OpenGraph\OpenGraphClient;
use OpenGraph\OpenGraphException;
use PHPUnit\Framework\TestCase;

class OpenGraphClientTest extends TestCase
{
    public function testObjectIsInstanceOfOpenGraphClient()
    {
        $og = new OpenGraphClient('XXXXXXXXXX');
        $this->assertTrue($og instanceof OpenGraphClient);
        unset($og);
    }

    public function testExceptionIsInstanceOfOpenGraphException()
    {
        $this->expectException(OpenGraphException::class);
        new OpenGraphClient();
    }

    public function testIsAPIKeyExist()
    {
        try {
            new OpenGraphClient();

            $this->fail("No Exceptions were thrown.");
        } catch(OpenGraphException $openGraphException) {
            $this->assertEquals($openGraphException->getMessage(), "Missing required param API key.");
        }
    }

    public function testCacheOKIsTypeOfBoolean()
    {
        try {
            new OpenGraphClient('XXXXXXXXXX', 'false');

            $this->fail("No Exceptions were thrown.");
        } catch(OpenGraphException $openGraphException) {
            $this->assertEquals($openGraphException->getMessage(), "Cache OK type should be of boolean type.");
        }
    }

    public function testFullRenderIsTypeOfBoolean()
    {
        try {
            new OpenGraphClient('XXXXXXXXXX', false, 'false');

            $this->fail("No Exceptions were thrown.");
        } catch(OpenGraphException $openGraphException) {
            $this->assertEquals($openGraphException->getMessage(), "Full render type should be of boolean type.");
        }
    }

    public function testAPIKeyIsTypeOfString()
    {
        try {
            new OpenGraphClient('XXXXXXXXXX', true, true, 1.1);

            $this->fail("No Exceptions were thrown.");
        } catch(OpenGraphException $openGraphException) {
            $this->assertEquals($openGraphException->getMessage(), "API version type should be of string type.");
        }
    }

    public function testFormURLIsMatched()
    {
        try {
            $og = new OpenGraphClient('XXXXXXXXXX', true, true, "1.1");
            $this->assertEquals(
                $og->fetch("https://www.opengraph.io"),
                "https://opengraph.io/api/1.1/site/https%3A%2F%2Fwww.opengraph.io?cache_ok=true&full_render=true&"
                . "app_id=XXXXXXXXXX"
            );
        } catch(OpenGraphException $openGraphException) {
            $this->fail($openGraphException->getMessage());
        } finally {
            unset($og);
        }
    }

    public function testAPIKeyIsInvalid()
    {
        try {
            $og = new OpenGraphClient('XXXXXXXXXX');
            $og->fetch("https://www.opengraph.io");

            $this->fail("No Exceptions were thrown.");
        } catch(OpenGraphException $openGraphException) {
            $this->assertEquals($openGraphException->getMessage(), "You have provided an invalid API key.");
        } finally {
            unset($og);
        }
    }
}
