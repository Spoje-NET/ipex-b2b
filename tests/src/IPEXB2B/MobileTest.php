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

use IPEXB2B\Mobile;
use PHPUnit\Framework\TestCase;

/**
 * Tests for the Mobile class.
 */
class MobileTest extends TestCase
{
    /**
     * @covers \IPEXB2B\Mobile::getMobileNumber
     */
    public function testGetMobileNumber(): void
    {
        $mobile = $this->getMockBuilder(Mobile::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData', 'setUrlParams'])
            ->getMock();

        $mobile->expects($this->once())->method('setUrlParams');
        $mobile->expects($this->once())
            ->method('requestData')
            ->with('123456789')
            ->willReturn(['results' => [['id' => 1]]]);

        $result = $mobile->getMobileNumber('123456789');
        $this->assertEquals([['id' => 1]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Mobile::createMobileNumber
     */
    public function testCreateMobileNumber(): void
    {
        $mobile = $this->getMockBuilder(Mobile::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData', 'setPostFields'])
            ->getMock();

        $mobile->expects($this->once())->method('setPostFields');
        $mobile->expects($this->once())
            ->method('requestData')
            ->with('', 'POST')
            ->willReturn(['results' => [['id' => 2]]]);

        $result = $mobile->createMobileNumber(['number' => '123456789']);
        $this->assertEquals([['id' => 2]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Mobile::updateMobileNumber
     */
    public function testUpdateMobileNumber(): void
    {
        $mobile = $this->getMockBuilder(Mobile::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData', 'setPostFields'])
            ->getMock();

        $mobile->expects($this->once())->method('setPostFields');
        $mobile->expects($this->once())
            ->method('requestData')
            ->with('', 'PUT')
            ->willReturn(['results' => [['id' => 1]]]);

        $result = $mobile->updateMobileNumber(['number' => '123456789']);
        $this->assertEquals([['id' => 1]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Mobile::getAvailablePortationDates
     */
    public function testGetAvailablePortationDates(): void
    {
        $mobile = $this->getMockBuilder(Mobile::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData'])
            ->getMock();

        $mobile->expects($this->once())
            ->method('requestData')
            ->with('availablePortationDates/12345')
            ->willReturn(['results' => [['date' => '2023-10-27']]]);

        $result = $mobile->getAvailablePortationDates(12345);
        $this->assertEquals([['date' => '2023-10-27']], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Mobile::resetPostpaidLimit
     */
    public function testResetPostpaidLimit(): void
    {
        $mobile = $this->getMockBuilder(Mobile::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData'])
            ->getMock();

        $mobile->expects($this->once())
            ->method('requestData')
            ->with('123/resetPostpaidLimit')
            ->willReturn(['results' => [['success' => true]]]);

        $result = $mobile->resetPostpaidLimit(123);
        $this->assertEquals([['success' => true]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Mobile::resetPostpaidLimitPut
     */
    public function testResetPostpaidLimitPut(): void
    {
        $mobile = $this->getMockBuilder(Mobile::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData'])
            ->getMock();

        $mobile->expects($this->once())
            ->method('requestData')
            ->with('123/resetPostpaidLimit', 'PUT')
            ->willReturn(['results' => [['success' => true]]]);

        $result = $mobile->resetPostpaidLimitPut(123);
        $this->assertEquals([['success' => true]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Mobile::suspendMobileNumber
     */
    public function testSuspendMobileNumber(): void
    {
        $mobile = $this->getMockBuilder(Mobile::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData'])
            ->getMock();

        $mobile->expects($this->once())
            ->method('requestData')
            ->with('123/suspend')
            ->willReturn(['results' => [['success' => true]]]);

        $result = $mobile->suspendMobileNumber(123);
        $this->assertEquals([['success' => true]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Mobile::suspendMobileNumberPut
     */
    public function testSuspendMobileNumberPut(): void
    {
        $mobile = $this->getMockBuilder(Mobile::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData'])
            ->getMock();

        $mobile->expects($this->once())
            ->method('requestData')
            ->with('123/suspend', 'PUT')
            ->willReturn(['results' => [['success' => true]]]);

        $result = $mobile->suspendMobileNumberPut(123);
        $this->assertEquals([['success' => true]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Mobile::reactivateMobileNumber
     */
    public function testReactivateMobileNumber(): void
    {
        $mobile = $this->getMockBuilder(Mobile::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData'])
            ->getMock();

        $mobile->expects($this->once())
            ->method('requestData')
            ->with('123/reactivate')
            ->willReturn(['results' => [['success' => true]]]);

        $result = $mobile->reactivateMobileNumber(123);
        $this->assertEquals([['success' => true]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Mobile::reactivateMobileNumberPut
     */
    public function testReactivateMobileNumberPut(): void
    {
        $mobile = $this->getMockBuilder(Mobile::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData'])
            ->getMock();

        $mobile->expects($this->once())
            ->method('requestData')
            ->with('123/reactivate', 'PUT')
            ->willReturn(['results' => [['success' => true]]]);

        $result = $mobile->reactivateMobileNumberPut(123);
        $this->assertEquals([['success' => true]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Mobile::getCreditHistory
     */
    public function testGetCreditHistory(): void
    {
        $mobile = $this->getMockBuilder(Mobile::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData'])
            ->getMock();

        $mobile->expects($this->once())
            ->method('requestData')
            ->with('123456789/credit')
            ->willReturn(['results' => [['amount' => 100]]]);

        $result = $mobile->getCreditHistory('123456789');
        $this->assertEquals([['amount' => 100]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Mobile::addCredit
     */
    public function testAddCredit(): void
    {
        $mobile = $this->getMockBuilder(Mobile::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData', 'setPostFields'])
            ->getMock();

        $mobile->expects($this->once())->method('setPostFields');
        $mobile->expects($this->once())
            ->method('requestData')
            ->with('123456789/credit', 'PUT')
            ->willReturn(['results' => [['success' => true]]]);

        $result = $mobile->addCredit('123456789', ['amount' => 100]);
        $this->assertEquals([['success' => true]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Mobile::changeSimCard
     */
    public function testChangeSimCard(): void
    {
        $mobile = $this->getMockBuilder(Mobile::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData'])
            ->getMock();

        $mobile->expects($this->once())
            ->method('requestData')
            ->with('123/changeSimCard/456')
            ->willReturn(['results' => [['success' => true]]]);

        $result = $mobile->changeSimCard(123, 456);
        $this->assertEquals([['success' => true]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Mobile::renewSimCard
     */
    public function testRenewSimCard(): void
    {
        $mobile = $this->getMockBuilder(Mobile::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData', 'setPostFields'])
            ->getMock();

        $mobile->expects($this->once())->method('setPostFields');
        $mobile->expects($this->once())
            ->method('requestData')
            ->with('123/renew', 'PUT')
            ->willReturn(['results' => [['success' => true]]]);

        $result = $mobile->renewSimCard(123, ['newIccid' => '456']);
        $this->assertEquals([['success' => true]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Mobile::deactivateMobileNumber
     */
    public function testDeactivateMobileNumber(): void
    {
        $mobile = $this->getMockBuilder(Mobile::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData', 'setPostFields'])
            ->getMock();

        $mobile->expects($this->once())->method('setPostFields');
        $mobile->expects($this->once())
            ->method('requestData')
            ->with('123/deactivate', 'PUT')
            ->willReturn(['results' => [['success' => true]]]);

        $result = $mobile->deactivateMobileNumber(123, ['reason' => 'test']);
        $this->assertEquals([['success' => true]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Mobile::updateOku
     */
    public function testUpdateOku(): void
    {
        $mobile = $this->getMockBuilder(Mobile::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData', 'setPostFields'])
            ->getMock();

        $mobile->expects($this->once())->method('setPostFields');
        $mobile->expects($this->once())
            ->method('requestData')
            ->with('123456789/oku', 'PUT')
            ->willReturn(['results' => [['success' => true]]]);

        $result = $mobile->updateOku('123456789', ['oku' => '123']);
        $this->assertEquals([['success' => true]], $result['results']);
    }
}
