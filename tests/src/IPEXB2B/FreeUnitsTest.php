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

use IPEXB2B\FreeUnits;
use PHPUnit\Framework\TestCase;

/**
 * Tests for the FreeUnits class.
 */
class FreeUnitsTest extends TestCase
{
    /**
     * @covers \IPEXB2B\FreeUnits::getHistory
     */
    public function testGetHistory(): void
    {
        $freeUnits = $this->getMockBuilder(FreeUnits::class)
            ->onlyMethods(['requestData', 'setUrlParams'])
            ->getMock();

        $freeUnits->expects($this->once())->method('setUrlParams');
        $freeUnits->expects($this->once())
            ->method('requestData')
            ->with('history')
            ->willReturn(['results' => [['id' => 1]]]);

        $result = $freeUnits->getHistory(['year' => 2023, 'month' => 10]);
        $this->assertEquals([['id' => 1]], $result['results']);
    }
}
