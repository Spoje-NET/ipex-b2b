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

use IPEXB2B\WholesaleInvoices;
use PHPUnit\Framework\TestCase;

/**
 * Tests for the WholesaleInvoices class.
 */
class WholesaleInvoicesTest extends TestCase
{
    /**
     * @covers \IPEXB2B\WholesaleInvoices::getWholesaleInvoices
     */
    public function testGetWholesaleInvoices(): void
    {
        $wholesaleInvoices = $this->getMockBuilder(WholesaleInvoices::class)
            ->onlyMethods(['requestData', 'setUrlParams'])
            ->getMock();

        $wholesaleInvoices->expects($this->once())->method('setUrlParams');
        $wholesaleInvoices->expects($this->once())
            ->method('requestData')
            ->willReturn(['results' => [['id' => 1]]]);

        $result = $wholesaleInvoices->getWholesaleInvoices();
        $this->assertEquals([['id' => 1]], $result['results']);
    }
}
