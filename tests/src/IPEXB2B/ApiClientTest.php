<?php

declare(strict_types=1);

/**
 * This file is part of the IpexB2B package
 *
 * https://github.com/Spoje-NET/ipex-b2b
 *
 * (c) Spoje.Net <https://spoje.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Test\IPEXB2B;

use IPEXB2B\ApiClient;
use PHPUnit\Framework\TestCase;

class ApiClientTest extends TestCase
{
    /**
     * @covers \IPEXB2B\ApiClient::setUp
     */
    public function testSetUp(): void
    {
        $object = $this->getMockBuilder(ApiClient::class)->disableOriginalConstructor()->getMock();
        $options = [
            'url' => 'https://test.ipex.cz',
            'user' => 'testuser',
            'password' => 'testpass',
            'section' => 'testsection',
            'debug' => true,
            'defaultUrlParams' => ['limit' => 10],
        ];
        $object->setUp($options);
        $this->assertEquals('https://test.ipex.cz', $object->url);
        $this->assertEquals('testuser', $object->user);
        $this->assertEquals('testpass', $object->password);
        $this->assertEquals('testsection', $object->getSection());
        $this->assertEquals(['limit' => 10], $object->defaultUrlParams);
        $this->assertTrue($object->debug);
    }

    /**
     * @covers \IPEXB2B\ApiClient::curlInit
     */
    public function testCurlInit(): void
    {
        $object = $this->getMockBuilder(ApiClient::class)->disableOriginalConstructor()->getMock();
        $object->curlInit();
        $this->assertIsResource($object->curl);
    }

    /**
     * @covers \IPEXB2B\ApiClient::setSection
     * @covers \IPEXB2B\ApiClient::getSection
     */
    public function testSetAndGetSection(): void
    {
        $object = $this->getMockBuilder(ApiClient::class)->disableOriginalConstructor()->getMock();
        $section = 'new-section';
        $object->setSection($section);
        $this->assertEquals($section, $object->getSection());
    }

    /**
     * @covers \IPEXB2B\ApiClient::setPostFields
     */
    public function testSetPostFields(): void
    {
        $object = $this->getMockBuilder(ApiClient::class)->disableOriginalConstructor()->getMock();
        $postData = '{"key":"value"}';
        $object->setPostFields($postData);

        $reflection = new \ReflectionObject($object);
        $property = $reflection->getProperty('postFields');
        $property->setAccessible(true);
        $this->assertEquals($postData, $property->getValue($object));
    }

    /**
     * @covers \IPEXB2B\ApiClient::getSectionURL
     */
    public function testGetSectionURL(): void
    {
        $object = $this->getMockBuilder(ApiClient::class)->disableOriginalConstructor()->getMock();
        $object->setUp(['url' => 'https://api.example.com']);
        $object->setSection('items');
        $this->assertEquals('https://api.example.com/v1/items', $object->getSectionURL());
    }

    /**
     * @covers \IPEXB2B\ApiClient::setUrlParams
     */
    public function testSetUrlParams(): void
    {
        $object = $this->getMockBuilder(ApiClient::class)->disableOriginalConstructor()->getMock();
        $object->urlParams = [];
        $object->setUrlParams(['a' => 'b']);
        $this->assertEquals(['a' => 'b'], $object->urlParams);
        $object->setUrlParams(['c' => 'd']);
        $this->assertEquals(['a' => 'b', 'c' => 'd'], $object->urlParams);
    }


    /**
     * @covers \IPEXB2B\ApiClient::ipexDateTimeToDateTime
     */
    public function testIpexDateTimeToDateTime(): void
    {
        $phpDateTime = ApiClient::ipexDateTimeToDateTime('2018-04-30T23:59:59.000Z');
        $this->assertInstanceOf(\DateTime::class, $phpDateTime);
        $this->assertEquals('2018-04-30 23:59:59', $phpDateTime->format('Y-m-d H:i:s'));
    }

    /**
     * @covers \IPEXB2B\ApiClient::dateTimeToIpexDate
     */
    public function testDateTimeToIpexDate(): void
    {
        $dateTime = new \DateTime('2023-10-27');
        $this->assertEquals('2023-10-27', ApiClient::dateTimeToIpexDate($dateTime));
    }


    /**
     * @covers \IPEXB2B\ApiClient::ignore404
     */
    public function testIgnore404(): void
    {
        $object = $this->getMockBuilder(ApiClient::class)->disableOriginalConstructor()->getMock();
        $this->assertFalse($object->ignore404()); // Default is false
        $this->assertTrue($object->ignore404(true));
        $this->assertTrue($object->ignore404());
    }

    /**
     * @covers \IPEXB2B\ApiClient::disconnect
     */
    public function testDisconnect(): void
    {
        $object = $this->getMockBuilder(ApiClient::class)->disableOriginalConstructor()->getMock();
        $object->curlInit();
        $object->disconnect();
        $this->assertNull($object->curl);
    }
}
