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

use IPEXB2B\Connectors;
use PHPUnit\Framework\TestCase;

/**
 * Tests for the Connectors class.
 */
class ConnectorsTest extends TestCase
{
    /**
     * @covers \IPEXB2B\Connectors::getConnectors
     */
    public function testGetConnectors(): void
    {
        $connectors = $this->getMockBuilder(Connectors::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData', 'setUrlParams'])
            ->getMock();

        $connectors->expects($this->once())->method('setUrlParams');
        $connectors->expects($this->once())
            ->method('requestData')
            ->willReturn(['results' => [['id' => 1]]]);

        $result = $connectors->getConnectors();
        $this->assertEquals([['id' => 1]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Connectors::createConnector
     */
    public function testCreateConnector(): void
    {
        $connectors = $this->getMockBuilder(Connectors::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData', 'setPostFields'])
            ->getMock();

        $connectors->expects($this->once())->method('setPostFields');
        $connectors->expects($this->once())
            ->method('requestData')
            ->with('', 'POST')
            ->willReturn(['results' => [['id' => 2]]]);

        $result = $connectors->createConnector(['name' => 'test']);
        $this->assertEquals([['id' => 2]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Connectors::getConnectorsInvoices
     */
    public function testGetConnectorsInvoices(): void
    {
        $connectors = $this->getMockBuilder(Connectors::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData', 'setUrlParams'])
            ->getMock();

        $connectors->expects($this->once())->method('setUrlParams');
        $connectors->expects($this->once())
            ->method('requestData')
            ->with('invoices')
            ->willReturn(['results' => [['id' => 3]]]);

        $result = $connectors->getConnectorsInvoices(['dateFrom' => '2023-01-01', 'dateTo' => '2023-01-31']);
        $this->assertEquals([['id' => 3]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Connectors::getConnectorById
     */
    public function testGetConnectorById(): void
    {
        $connectors = $this->getMockBuilder(Connectors::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData'])
            ->getMock();

        $connectors->expects($this->once())
            ->method('requestData')
            ->with('123')
            ->willReturn(['results' => [['id' => 123]]]);

        $result = $connectors->getConnectorById(123);
        $this->assertEquals([['id' => 123]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Connectors::updateConnector
     */
    public function testUpdateConnector(): void
    {
        $connectors = $this->getMockBuilder(Connectors::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData', 'setPostFields'])
            ->getMock();

        $connectors->expects($this->once())->method('setPostFields');
        $connectors->expects($this->once())
            ->method('requestData')
            ->with('123', 'PUT')
            ->willReturn(['results' => [['id' => 123]]]);

        $result = $connectors->updateConnector(123, ['name' => 'updated']);
        $this->assertEquals([['id' => 123]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Connectors::getConnectorInvoices
     */
    public function testGetConnectorInvoices(): void
    {
        $connectors = $this->getMockBuilder(Connectors::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData', 'setUrlParams'])
            ->getMock();

        $connectors->expects($this->once())->method('setUrlParams');
        $connectors->expects($this->once())
            ->method('requestData')
            ->with('123/invoices')
            ->willReturn(['results' => [['id' => 4]]]);

        $result = $connectors->getConnectorInvoices(123);
        $this->assertEquals([['id' => 4]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Connectors::getConnectorPhoneNumbers
     */
    public function testGetConnectorPhoneNumbers(): void
    {
        $connectors = $this->getMockBuilder(Connectors::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData', 'setUrlParams'])
            ->getMock();

        $connectors->expects($this->once())->method('setUrlParams');
        $connectors->expects($this->once())
            ->method('requestData')
            ->with('123/phoneNumbers')
            ->willReturn(['results' => [['number' => '123456789']]]);

        $result = $connectors->getConnectorPhoneNumbers(123);
        $this->assertEquals([['number' => '123456789']], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Connectors::portInToConnector
     */
    public function testPortInToConnector(): void
    {
        $connectors = $this->getMockBuilder(Connectors::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData', 'setPostFields'])
            ->getMock();

        $connectors->expects($this->once())->method('setPostFields');
        $connectors->expects($this->once())
            ->method('requestData')
            ->with('123/portIn', 'POST')
            ->willReturn(['results' => [['success' => true]]]);

        $result = $connectors->portInToConnector(123, ['numbers' => ['123456789']]);
        $this->assertEquals([['success' => true]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Connectors::orderNewBlock
     */
    public function testOrderNewBlock(): void
    {
        $connectors = $this->getMockBuilder(Connectors::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData', 'setPostFields'])
            ->getMock();

        $connectors->expects($this->once())->method('setPostFields');
        $connectors->expects($this->once())
            ->method('requestData')
            ->with('123/orderNewBlock', 'POST')
            ->willReturn(['results' => [['success' => true]]]);

        $result = $connectors->orderNewBlock(123, ['count' => 10]);
        $this->assertEquals([['success' => true]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Connectors::deactivateConnector
     */
    public function testDeactivateConnector(): void
    {
        $connectors = $this->getMockBuilder(Connectors::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData', 'setPostFields'])
            ->getMock();

        $connectors->expects($this->once())->method('setPostFields');
        $connectors->expects($this->once())
            ->method('requestData')
            ->with('123/deactivate', 'POST')
            ->willReturn(['results' => [['success' => true]]]);

        $result = $connectors->deactivateConnector(123, ['reason' => 'test']);
        $this->assertEquals([['success' => true]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Connectors::updateConnectorPhoneNumber
     */
    public function testUpdateConnectorPhoneNumber(): void
    {
        $connectors = $this->getMockBuilder(Connectors::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData', 'setPostFields'])
            ->getMock();

        $connectors->expects($this->once())->method('setPostFields');
        $connectors->expects($this->once())
            ->method('requestData')
            ->with('123/phoneNumbers/123456789', 'PUT')
            ->willReturn(['results' => [['success' => true]]]);

        $result = $connectors->updateConnectorPhoneNumber(123, '123456789', ['name' => 'updated']);
        $this->assertEquals([['success' => true]], $result['results']);
    }
}
