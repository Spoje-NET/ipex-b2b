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

use IPEXB2B\Ticketing;
use PHPUnit\Framework\TestCase;

/**
 * Tests for the Ticketing class.
 */
class TicketingTest extends TestCase
{
    /**
     * @covers \IPEXB2B\Ticketing::checkUser
     */
    public function testCheckUser(): void
    {
        $ticketing = $this->getMockBuilder(Ticketing::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData'])
            ->getMock();

        $ticketing->expects($this->once())
            ->method('requestData')
            ->with('check-user')
            ->willReturn(['results' => [['userExist' => true]]]);

        $result = $ticketing->checkUser();
        $this->assertEquals([['userExist' => true]], $result['results']);
    }
}
