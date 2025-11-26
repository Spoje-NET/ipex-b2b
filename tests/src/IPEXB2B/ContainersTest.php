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

use IPEXB2B\Containers;
use PHPUnit\Framework\TestCase;

/**
 * Tests for the Containers class.
 */
class ContainersTest extends TestCase
{
    /**
     * @covers \IPEXB2B\Containers::getContainers
     */
    public function testGetContainers(): void
    {
        $containers = $this->getMockBuilder(Containers::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData'])
            ->getMock();

        $containers->expects($this->once())
            ->method('requestData')
            ->with('Mobile')
            ->willReturn(['results' => [['id' => 1]]]);

        $result = $containers->getContainers('Mobile');
        $this->assertEquals([['id' => 1]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Containers::getRoamingProfiles
     */
    public function testGetRoamingProfiles(): void
    {
        $containers = $this->getMockBuilder(Containers::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData'])
            ->getMock();

        $containers->expects($this->once())
            ->method('requestData')
            ->with('123/roamingProfiles')
            ->willReturn(['results' => [['id' => 1]]]);

        $result = $containers->getRoamingProfiles(123);
        $this->assertEquals([['id' => 1]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Containers::getPhoneNumbers
     */
    public function testGetPhoneNumbers(): void
    {
        $containers = $this->getMockBuilder(Containers::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData', 'setUrlParams'])
            ->getMock();

        $containers->expects($this->once())->method('setUrlParams');
        $containers->expects($this->once())
            ->method('requestData')
            ->with('123/phoneNumbers')
            ->willReturn(['results' => [['number' => '123456789']]]);

        $result = $containers->getPhoneNumbers(123);
        $this->assertEquals([['number' => '123456789']], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Containers::getDataPacks
     */
    public function testGetDataPacks(): void
    {
        $containers = $this->getMockBuilder(Containers::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData', 'setUrlParams'])
            ->getMock();

        $containers->expects($this->once())->method('setUrlParams');
        $containers->expects($this->once())
            ->method('requestData')
            ->with('123/dataPacks')
            ->willReturn(['results' => [['id' => 1]]]);

        $result = $containers->getDataPacks(123);
        $this->assertEquals([['id' => 1]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Containers::getFlatPacks
     */
    public function testGetFlatPacks(): void
    {
        $containers = $this->getMockBuilder(Containers::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData', 'setUrlParams'])
            ->getMock();

        $containers->expects($this->once())->method('setUrlParams');
        $containers->expects($this->once())
            ->method('requestData')
            ->with('123/flatPacks')
            ->willReturn(['results' => [['id' => 1]]]);

        $result = $containers->getFlatPacks(123);
        $this->assertEquals([['id' => 1]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Containers::getSimcards
     */
    public function testGetSimcards(): void
    {
        $containers = $this->getMockBuilder(Containers::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData', 'setUrlParams'])
            ->getMock();

        $containers->expects($this->once())->method('setUrlParams');
        $containers->expects($this->once())
            ->method('requestData')
            ->with('123/simcards')
            ->willReturn(['results' => [['iccid' => '12345']]]);

        $result = $containers->getSimcards(123);
        $this->assertEquals([['iccid' => '12345']], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Containers::portIn
     */
    public function testPortIn(): void
    {
        $containers = $this->getMockBuilder(Containers::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData', 'setPostFields'])
            ->getMock();

        $containers->expects($this->once())->method('setPostFields');
        $containers->expects($this->once())
            ->method('requestData')
            ->with('123/portIn', 'POST')
            ->willReturn(['results' => [['success' => true]]]);

        $result = $containers->portIn(123, ['numbers' => ['123456789']]);
        $this->assertEquals([['success' => true]], $result['results']);
    }
}
