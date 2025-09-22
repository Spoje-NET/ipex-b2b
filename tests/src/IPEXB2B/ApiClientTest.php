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
    protected ApiClient $object;

    protected function setUp(): void
    {
        $this->object = new ApiClient();
    }

    /**
     * @covers \IPEXB2B\ApiClient::setUp
     */
    public function testSetUp(): void
    {
        $options = [
            'url' => 'https://test.ipex.cz',
            'user' => 'testuser',
            'password' => 'testpass',
            'section' => 'testsection',
            'debug' => true,
            'defaultUrlParams' => ['limit' => 10],
        ];
        $this->object->setUp($options);
        $this->assertEquals('https://test.ipex.cz', $this->object->url);
        $this->assertEquals('testuser', $this->object->user);
        $this->assertEquals('testpass', $this->object->password);
        $this->assertEquals('testsection', $this->object->getSection());
        $this->assertEquals(['limit' => 10], $this->object->defaultUrlParams);
        $this->assertTrue($this->object->debug);
    }

    /**
     * @covers \IPEXB2B\ApiClient::curlInit
     */
    public function testCurlInit(): void
    {
        $this->object->curlInit();
        $this->assertIsResource($this->object->curl);
    }

    /**
     * @covers \IPEXB2B\ApiClient::setSection
     * @covers \IPEXB2B\ApiClient::getSection
     */
    public function testSetAndGetSection(): void
    {
        $section = 'new-section';
        $this->object->setSection($section);
        $this->assertEquals($section, $this->object->getSection());
    }

    /**
     * @covers \IPEXB2B\ApiClient::setPostFields
     */
    public function testSetPostFields(): void
    {
        $postData = '{"key":"value"}';
        $this->assertEquals($postData, $this->object->setPostFields($postData));
    }

    /**
     * @covers \IPEXB2B\ApiClient::getSectionURL
     */
    public function testGetSectionURL(): void
    {
        $this->object->setUp(['url' => 'https://api.example.com']);
        $this->object->setSection('items');
        $this->assertEquals('https://api.example.com/v1/items', $this->object->getSectionURL());
    }

    /**
     * @covers \IPEXB2B\ApiClient::setUrlParams
     */
    public function testSetUrlParams(): void
    {
        $this->object->urlParams = [];
        $this->object->setUrlParams(['a' => 'b']);
        $this->assertEquals(['a' => 'b'], $this->object->urlParams);
        $this->object->setUrlParams(['c' => 'd']);
        $this->assertEquals(['a' => 'b', 'c' => 'd'], $this->object->urlParams);
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
        $this->assertFalse($this->object->ignore404()); // Default is false
        $this->assertTrue($this->object->ignore404(true));
        $this->assertTrue($this->object->ignore404());
    }

    /**
     * @covers \IPEXB2B\ApiClient::disconnect
     */
    public function testDisconnect(): void
    {
        $this->object->curlInit();
        $this->object->disconnect();
        $this->assertNull($this->object->curl);
    }
}
