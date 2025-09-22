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

use IPEXB2B\Sms;
use PHPUnit\Framework\TestCase;

/**
 * Tests for the Sms class.
 */
class SmsTest extends TestCase
{
    /**
     * @covers \IPEXB2B\Sms::sendSms
     */
    public function testSendSms(): void
    {
        $sms = $this->getMockBuilder(Sms::class)
            ->onlyMethods(['requestData', 'setPostFields'])
            ->getMock();

        $sms->expects($this->once())->method('setPostFields');
        $sms->expects($this->once())
            ->method('requestData')
            ->with('', 'POST')
            ->willReturn(['results' => [['sent' => true]]]);

        $result = $sms->sendSms(['to' => '123456789', 'message' => 'test']);
        $this->assertEquals([['sent' => true]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Sms::getSmsIntegration
     */
    public function testGetSmsIntegration(): void
    {
        $sms = $this->getMockBuilder(Sms::class)
            ->onlyMethods(['requestData'])
            ->getMock();

        $sms->expects($this->once())
            ->method('requestData')
            ->with('integration/123')
            ->willReturn(['results' => [['id' => 123]]]);

        $result = $sms->getSmsIntegration(123);
        $this->assertEquals([['id' => 123]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Sms::updateSmsIntegration
     */
    public function testUpdateSmsIntegration(): void
    {
        $sms = $this->getMockBuilder(Sms::class)
            ->onlyMethods(['requestData', 'setPostFields'])
            ->getMock();

        $sms->expects($this->once())->method('setPostFields');
        $sms->expects($this->once())
            ->method('requestData')
            ->with('integration/123', 'PUT')
            ->willReturn(['results' => [['id' => 123]]]);

        $result = $sms->updateSmsIntegration(123, ['name' => 'updated']);
        $this->assertEquals([['id' => 123]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Sms::createSmsIntegration
     */
    public function testCreateSmsIntegration(): void
    {
        $sms = $this->getMockBuilder(Sms::class)
            ->onlyMethods(['requestData', 'setPostFields'])
            ->getMock();

        $sms->expects($this->once())->method('setPostFields');
        $sms->expects($this->once())
            ->method('requestData')
            ->with('integration', 'POST')
            ->willReturn(['results' => [['id' => 2]]]);

        $result = $sms->createSmsIntegration(['name' => 'test']);
        $this->assertEquals([['id' => 2]], $result['results']);
    }
}
