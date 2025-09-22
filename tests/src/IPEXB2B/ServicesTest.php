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

use IPEXB2B\Services;
use PHPUnit\Framework\TestCase;

/**
 * Tests for the Services class.
 */
class ServicesTest extends TestCase
{
    /**
     * @covers \IPEXB2B\Services::getServices
     */
    public function testGetServices(): void
    {
        $services = $this->getMockBuilder(Services::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData', 'setUrlParams'])
            ->getMock();

        $services->expects($this->once())->method('setUrlParams');
        $services->expects($this->once())
            ->method('requestData')
            ->willReturn(['results' => [['id' => 1, 'name' => 'Test Service']]]);

        $result = $services->getServices();
        $this->assertEquals([['id' => 1, 'name' => 'Test Service']], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Services::getServiceById
     */
    public function testGetServiceById(): void
    {
        $services = $this->getMockBuilder(Services::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData'])
            ->getMock();

        $services->expects($this->once())
            ->method('requestData')
            ->with('123')
            ->willReturn(['results' => [['id' => 123, 'name' => 'Test Service']]]);

        $result = $services->getServiceById(123);
        $this->assertEquals([['id' => 123, 'name' => 'Test Service']], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Services::deleteService
     */
    public function testDeleteService(): void
    {
        $services = $this->getMockBuilder(Services::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData'])
            ->getMock();

        $services->expects($this->once())
            ->method('requestData')
            ->with('123', 'DELETE')
            ->willReturn(['results' => [['id' => 123, 'status' => 'deleted']]]);

        $result = $services->deleteService(123);
        $this->assertEquals([['id' => 123, 'status' => 'deleted']], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Services::fulltextSearch
     */
    public function testFulltextSearch(): void
    {
        $services = $this->getMockBuilder(Services::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData', 'setUrlParams'])
            ->getMock();

        $services->expects($this->once())->method('setUrlParams');
        $services->expects($this->once())
            ->method('requestData')
            ->with('fulltext')
            ->willReturn(['results' => [['id' => 1, 'name' => 'Found Service']]]);

        $result = $services->fulltextSearch(['q' => 'test']);
        $this->assertEquals([['id' => 1, 'name' => 'Found Service']], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Services::getSharedServices
     */
    public function testGetSharedServices(): void
    {
        $services = $this->getMockBuilder(Services::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData', 'setUrlParams'])
            ->getMock();

        $services->expects($this->once())->method('setUrlParams');
        $services->expects($this->once())
            ->method('requestData')
            ->with('shared')
            ->willReturn(['results' => [['id' => 1, 'name' => 'Shared Service']]]);

        $result = $services->getSharedServices();
        $this->assertEquals([['id' => 1, 'name' => 'Shared Service']], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Services::getServiceProperties
     */
    public function testGetServiceProperties(): void
    {
        $services = $this->getMockBuilder(Services::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData'])
            ->getMock();

        $services->expects($this->once())
            ->method('requestData')
            ->with('123/properties')
            ->willReturn(['results' => [['prop' => 'value']]]);

        $result = $services->getServiceProperties(123);
        $this->assertEquals([['prop' => 'value']], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Services::updateServiceProperties
     */
    public function testUpdateServiceProperties(): void
    {
        $services = $this->getMockBuilder(Services::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData', 'setPostFields'])
            ->getMock();

        $services->expects($this->once())->method('setPostFields');
        $services->expects($this->once())
            ->method('requestData')
            ->with('123/properties', 'PUT')
            ->willReturn(['results' => [['id' => 123]]]);

        $result = $services->updateServiceProperties(123, ['prop' => 'new_value']);
        $this->assertEquals([['id' => 123]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Services::bindSystemUser
     */
    public function testBindSystemUser(): void
    {
        $services = $this->getMockBuilder(Services::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData', 'setPostFields'])
            ->getMock();

        $services->expects($this->once())->method('setPostFields');
        $services->expects($this->once())
            ->method('requestData')
            ->with('123/systemUserBinding', 'PUT')
            ->willReturn(['results' => [['success' => true]]]);

        $result = $services->bindSystemUser(123, ['allowed' => true]);
        $this->assertEquals([['success' => true]], $result['results']);
    }
}
