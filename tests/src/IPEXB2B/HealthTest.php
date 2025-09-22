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

use IPEXB2B\Health;
use PHPUnit\Framework\TestCase;

/**
 * Tests for the Health class.
 */
class HealthTest extends TestCase
{
    /**
     * @covers \IPEXB2B\Health::getHealth
     */
    public function testGetHealth(): void
    {
        $health = $this->getMockBuilder(Health::class)
            ->onlyMethods(['requestData'])
            ->getMock();

        $health->expects($this->once())
            ->method('requestData')
            ->willReturn(['results' => [['status' => 'ok']]]);

        $result = $health->getHealth();
        $this->assertEquals([['status' => 'ok']], $result['results']);
    }
}
