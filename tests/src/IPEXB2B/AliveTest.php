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

use IPEXB2B\Alive;
use PHPUnit\Framework\TestCase;

/**
 * Tests for the Alive class.
 */
class AliveTest extends TestCase
{
    /**
     * @covers \IPEXB2B\Alive::getAlive
     */
    public function testGetAlive(): void
    {
        $alive = $this->getMockBuilder(Alive::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData'])
            ->getMock();

        $alive->expects($this->once())
            ->method('requestData')
            ->willReturn(['results' => [['status' => 'alive']]]);

        $result = $alive->getAlive();
        $this->assertEquals([['status' => 'alive']], $result['results']);
    }
}
