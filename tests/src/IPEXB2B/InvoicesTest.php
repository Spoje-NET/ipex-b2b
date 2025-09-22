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

use IPEXB2B\Invoices;
use PHPUnit\Framework\TestCase;

/**
 * Tests for the Invoices class.
 */
class InvoicesTest extends TestCase
{
    /**
     * @covers \IPEXB2B\Invoices::getInvoices
     */
    public function testGetInvoices(): void
    {
        $invoices = $this->getMockBuilder(Invoices::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData', 'setUrlParams'])
            ->getMock();

        $invoices->expects($this->once())->method('setUrlParams');
        $invoices->expects($this->once())
            ->method('requestData')
            ->willReturn(['results' => [['id' => 1]]]);

        $result = $invoices->getInvoices(['customerId' => 123]);
        $this->assertEquals([['id' => 1]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Invoices::getInvoicesByPaymentType
     */
    public function testGetInvoicesByPaymentType(): void
    {
        $invoices = $this->getMockBuilder(Invoices::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData', 'setUrlParams'])
            ->getMock();

        $invoices->expects($this->once())->method('setUrlParams');
        $invoices->expects($this->once())
            ->method('requestData')
            ->with('postpaid')
            ->willReturn(['results' => [['id' => 2]]]);

        $result = $invoices->getInvoicesByPaymentType('postpaid');
        $this->assertEquals([['id' => 2]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Invoices::getInvoiceFile
     */
    public function testGetInvoiceFile(): void
    {
        $invoices = $this->getMockBuilder(Invoices::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData', 'setUrlParams'])
            ->getMock();

        $invoices->expects($this->once())->method('setUrlParams');
        $invoices->expects($this->once())
            ->method('requestData')
            ->with('postpaid/pdf')
            ->willReturn(['results' => 'PDF_CONTENT']);

        $result = $invoices->getInvoiceFile('postpaid', 'pdf');
        $this->assertEquals('PDF_CONTENT', $result['results']);
    }
}
