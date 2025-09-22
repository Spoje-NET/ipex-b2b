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

use IPEXB2B\InvoiceItem;
use PHPUnit\Framework\TestCase;

/**
 * Tests for the InvoiceItem class.
 */
class InvoiceItemTest extends TestCase
{
    /**
     * @covers \IPEXB2B\InvoiceItem::getInvoiceItemIds
     */
    public function testGetInvoiceItemIds(): void
    {
        $invoiceItem = $this->getMockBuilder(InvoiceItem::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData'])
            ->getMock();

        $invoiceItem->expects($this->once())
            ->method('requestData')
            ->with('idList')
            ->willReturn(['results' => [['id' => 1]]]);

        $result = $invoiceItem->getInvoiceItemIds();
        $this->assertEquals([['id' => 1]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\InvoiceItem::getInvoiceItem
     */
    public function testGetInvoiceItem(): void
    {
        $invoiceItem = $this->getMockBuilder(InvoiceItem::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData'])
            ->getMock();

        $invoiceItem->expects($this->once())
            ->method('requestData')
            ->with('123')
            ->willReturn(['results' => [['id' => 123]]]);

        $result = $invoiceItem->getInvoiceItem(123);
        $this->assertEquals([['id' => 123]], $result['results']);
    }
}
