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

use IPEXB2B\Calls;
use DateTime;
use PHPUnit\Framework\TestCase;

/**
 * Tests for the Calls class.
 */
class CallsTest extends TestCase
{
    /**
     * @covers \IPEXB2B\Calls::getCallsForNumber
     */
    public function testGetCallsForNumber(): void
    {
        $calls = $this->getMockBuilder(Calls::class)
            ->onlyMethods(['requestData'])
            ->getMock();

        $calls->expects($this->once())
            ->method('requestData')
            ->willReturn(['results' => [['id' => 1]]]);

        $startDate = new DateTime('-1 month');
        $result = $calls->getCallsForNumber($startDate, '123456789');
        $this->assertEquals([['id' => 1]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Calls::getCallsForCustomer
     */
    public function testGetCallsForCustomer(): void
    {
        $calls = $this->getMockBuilder(Calls::class)
            ->onlyMethods(['requestData'])
            ->getMock();

        $calls->expects($this->once())
            ->method('requestData')
            ->willReturn(['results' => [['id' => 2]]]);

        $startDate = new DateTime('-1 month');
        $result = $calls->getCallsForCustomer($startDate, 987);
        $this->assertEquals([['id' => 2]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Calls::getTechnicalOverview
     */
    public function testGetTechnicalOverview(): void
    {
        $calls = $this->getMockBuilder(Calls::class)
            ->onlyMethods(['requestData'])
            ->getMock();

        $calls->expects($this->once())
            ->method('requestData')
            ->with('technical-overview')
            ->willReturn(['results' => [['tech' => 'data']]]);

        $result = $calls->getTechnicalOverview();
        $this->assertEquals([['tech' => 'data']], $result['results']);
    }
}
