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

use IPEXB2B\Reports;
use PHPUnit\Framework\TestCase;

/**
 * Tests for the Reports class.
 */
class ReportsTest extends TestCase
{
    /**
     * @covers \IPEXB2B\Reports::getCustomersReport
     */
    public function testGetCustomersReport(): void
    {
        $reports = $this->getMockBuilder(Reports::class)
            ->onlyMethods(['requestData'])
            ->getMock();

        $reports->expects($this->once())
            ->method('requestData')
            ->with('customers')
            ->willReturn(['results' => [['count' => 10]]]);

        $result = $reports->getCustomersReport();
        $this->assertEquals([['count' => 10]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Reports::getNumbersReport
     */
    public function testGetNumbersReport(): void
    {
        $reports = $this->getMockBuilder(Reports::class)
            ->onlyMethods(['requestData', 'setUrlParams'])
            ->getMock();

        $reports->expects($this->once())->method('setUrlParams');
        $reports->expects($this->once())
            ->method('requestData')
            ->with('numbers')
            ->willReturn(['results' => [['count' => 20]]]);

        $result = $reports->getNumbersReport();
        $this->assertEquals([['count' => 20]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Reports::getCtuReport
     */
    public function testGetCtuReport(): void
    {
        $reports = $this->getMockBuilder(Reports::class)
            ->onlyMethods(['requestData', 'setUrlParams'])
            ->getMock();

        $reports->expects($this->once())->method('setUrlParams');
        $reports->expects($this->once())
            ->method('requestData')
            ->with('cz/ctu')
            ->willReturn(['results' => [['data' => 'ctu data']]]);

        $result = $reports->getCtuReport();
        $this->assertEquals([['data' => 'ctu data']], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Reports::getTopCustomersReport
     */
    public function testGetTopCustomersReport(): void
    {
        $reports = $this->getMockBuilder(Reports::class)
            ->onlyMethods(['requestData', 'setUrlParams'])
            ->getMock();

        $reports->expects($this->once())->method('setUrlParams');
        $reports->expects($this->once())
            ->method('requestData')
            ->with('providers/top-customers')
            ->willReturn(['results' => [['id' => 1]]]);

        $result = $reports->getTopCustomersReport();
        $this->assertEquals([['id' => 1]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Reports::getCustomersCountReport
     */
    public function testGetCustomersCountReport(): void
    {
        $reports = $this->getMockBuilder(Reports::class)
            ->onlyMethods(['requestData'])
            ->getMock();

        $reports->expects($this->once())
            ->method('requestData')
            ->with('providers/customers/count')
            ->willReturn(['results' => [['count' => 5]]]);

        $result = $reports->getCustomersCountReport();
        $this->assertEquals([['count' => 5]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Reports::getRequestsCountReport
     */
    public function testGetRequestsCountReport(): void
    {
        $reports = $this->getMockBuilder(Reports::class)
            ->onlyMethods(['requestData', 'setUrlParams'])
            ->getMock();

        $reports->expects($this->once())->method('setUrlParams');
        $reports->expects($this->once())
            ->method('requestData')
            ->with('providers/requests/count')
            ->willReturn(['results' => [['count' => 3]]]);

        $result = $reports->getRequestsCountReport();
        $this->assertEquals([['count' => 3]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Reports::getZoomProviderReport
     */
    public function testGetZoomProviderReport(): void
    {
        $reports = $this->getMockBuilder(Reports::class)
            ->onlyMethods(['requestData'])
            ->getMock();

        $reports->expects($this->once())
            ->method('requestData')
            ->with('zoom/provider/2023-10-01')
            ->willReturn(['results' => [['data' => 'zoom data']]]);

        $result = $reports->getZoomProviderReport('2023-10-01');
        $this->assertEquals([['data' => 'zoom data']], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Reports::getConnectorPhoneNumbersCountReport
     */
    public function testGetConnectorPhoneNumbersCountReport(): void
    {
        $reports = $this->getMockBuilder(Reports::class)
            ->onlyMethods(['requestData'])
            ->getMock();

        $reports->expects($this->once())
            ->method('requestData')
            ->with('connectors/123/phoneNumbers/count')
            ->willReturn(['results' => [['count' => 7]]]);

        $result = $reports->getConnectorPhoneNumbersCountReport(123);
        $this->assertEquals([['count' => 7]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Reports::getCustomerServicesCountReport
     */
    public function testGetCustomerServicesCountReport(): void
    {
        $reports = $this->getMockBuilder(Reports::class)
            ->onlyMethods(['requestData', 'setUrlParams'])
            ->getMock();

        $reports->expects($this->once())->method('setUrlParams');
        $reports->expects($this->once())
            ->method('requestData')
            ->with('customers/456/services/count')
            ->willReturn(['results' => [['count' => 2]]]);

        $result = $reports->getCustomerServicesCountReport(456);
        $this->assertEquals([['count' => 2]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Reports::getCustomerRequestsCountReport
     */
    public function testGetCustomerRequestsCountReport(): void
    {
        $reports = $this->getMockBuilder(Reports::class)
            ->onlyMethods(['requestData'])
            ->getMock();

        $reports->expects($this->once())
            ->method('requestData')
            ->with('customers/456/requests/count')
            ->willReturn(['results' => [['count' => 1]]]);

        $result = $reports->getCustomerRequestsCountReport(456);
        $this->assertEquals([['count' => 1]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Reports::getZoomCustomerReport
     */
    public function testGetZoomCustomerReport(): void
    {
        $reports = $this->getMockBuilder(Reports::class)
            ->onlyMethods(['requestData'])
            ->getMock();

        $reports->expects($this->once())
            ->method('requestData')
            ->with('zoom/customer/456/2023-10-01')
            ->willReturn(['results' => [['data' => 'zoom customer data']]]);

        $result = $reports->getZoomCustomerReport(456, '2023-10-01');
        $this->assertEquals([['data' => 'zoom customer data']], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Reports::getCustomerInvoicesSumReport
     */
    public function testGetCustomerInvoicesSumReport(): void
    {
        $reports = $this->getMockBuilder(Reports::class)
            ->onlyMethods(['requestData'])
            ->getMock();

        $reports->expects($this->once())
            ->method('requestData')
            ->with('customers/456/invoices/sum/1')
            ->willReturn(['results' => [['sum' => 1000]]]);

        $result = $reports->getCustomerInvoicesSumReport(456, 1);
        $this->assertEquals([['sum' => 1000]], $result['results']);
    }
}
