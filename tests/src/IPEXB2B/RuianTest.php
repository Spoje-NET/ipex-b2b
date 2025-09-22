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

use IPEXB2B\Ruian;
use PHPUnit\Framework\TestCase;

/**
 * Tests for the Ruian class.
 */
class RuianTest extends TestCase
{
    /**
     * @covers \IPEXB2B\Ruian::getAddresses
     */
    public function testGetAddresses(): void
    {
        $ruian = $this->getMockBuilder(Ruian::class)
            ->onlyMethods(['requestData', 'setUrlParams'])
            ->getMock();

        $ruian->expects($this->once())->method('setUrlParams');
        $ruian->expects($this->once())
            ->method('requestData')
            ->with('test')
            ->willReturn(['results' => [['id' => 1]]]);

        $result = $ruian->getAddresses('test');
        $this->assertEquals([['id' => 1]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Ruian::getAddressById
     */
    public function testGetAddressById(): void
    {
        $ruian = $this->getMockBuilder(Ruian::class)
            ->onlyMethods(['requestData'])
            ->getMock();

        $ruian->expects($this->once())
            ->method('requestData')
            ->with('address/123')
            ->willReturn(['results' => [['id' => 123]]]);

        $result = $ruian->getAddressById(123);
        $this->assertEquals([['id' => 123]], $result['results']);
    }
}
