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

use IPEXB2B\Numbers;
use PHPUnit\Framework\TestCase;

/**
 * Tests for the Numbers class.
 */
class NumbersTest extends TestCase
{
    /**
     * @covers \IPEXB2B\Numbers::refreshOku
     */
    public function testRefreshOku(): void
    {
        $numbers = $this->getMockBuilder(Numbers::class)
            ->onlyMethods(['requestData', 'setPostFields'])
            ->getMock();

        $numbers->expects($this->once())->method('setPostFields');
        $numbers->expects($this->once())
            ->method('requestData')
            ->with('refresh-oku', 'PATCH')
            ->willReturn(['results' => [['success' => true]]]);

        $result = $numbers->refreshOku(['numbers' => ['123456789']]);
        $this->assertEquals([['success' => true]], $result['results']);
    }
}
