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

use IPEXB2B\Maintenance;
use PHPUnit\Framework\TestCase;

/**
 * Tests for the Maintenance class.
 */
class MaintenanceTest extends TestCase
{
    /**
     * @covers \IPEXB2B\Maintenance::checkIncomeDrop
     */
    public function testCheckIncomeDrop(): void
    {
        $maintenance = $this->getMockBuilder(Maintenance::class)
            ->onlyMethods(['requestData', 'setPostFields'])
            ->getMock();

        $maintenance->expects($this->once())->method('setPostFields');
        $maintenance->expects($this->once())
            ->method('requestData')
            ->with('calls/checkIncomeDrop', 'POST')
            ->willReturn(['results' => [['success' => true]]]);

        $result = $maintenance->checkIncomeDrop(['createTicket' => true]);
        $this->assertEquals([['success' => true]], $result['results']);
    }
}
