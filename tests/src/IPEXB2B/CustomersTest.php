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

use IPEXB2B\Customers;
use PHPUnit\Framework\TestCase;

/**
 * Tests for the Customers class.
 */
class CustomersTest extends TestCase
{
    /**
     * @covers \IPEXB2B\Customers::getCustomers
     */
    public function testGetCustomers(): void
    {
        $customers = $this->getMockBuilder(Customers::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData', 'setUrlParams'])
            ->getMock();

        $customers->expects($this->once())->method('setUrlParams');
        $customers->expects($this->once())
            ->method('requestData')
            ->willReturn(['results' => [['id' => 1, 'name' => 'Test Customer']]]);

        $result = $customers->getCustomers();
        $this->assertEquals([['id' => 1, 'name' => 'Test Customer']], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Customers::getCustomerById
     */
    public function testGetCustomerById(): void
    {
        $customers = $this->getMockBuilder(Customers::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData'])
            ->getMock();

        $customers->expects($this->once())
            ->method('requestData')
            ->with('123')
            ->willReturn(['results' => [['id' => 123, 'name' => 'Test Customer']]]);

        $result = $customers->getCustomerById(123);
        $this->assertEquals([['id' => 123, 'name' => 'Test Customer']], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Customers::createCustomer
     */
    public function testCreateCustomer(): void
    {
        $customers = $this->getMockBuilder(Customers::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData', 'setPostFields'])
            ->getMock();

        $customers->expects($this->once())->method('setPostFields');
        $customers->expects($this->once())
            ->method('requestData')
            ->with('', 'POST')
            ->willReturn(['results' => [['id' => 124]]]);

        $result = $customers->createCustomer(['name' => 'New Customer']);
        $this->assertEquals([['id' => 124]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Customers::updateCustomer
     */
    public function testUpdateCustomer(): void
    {
        $customers = $this->getMockBuilder(Customers::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData', 'setPostFields'])
            ->getMock();

        $customers->expects($this->once())->method('setPostFields');
        $customers->expects($this->once())
            ->method('requestData')
            ->with('123', 'PUT')
            ->willReturn(['results' => [['id' => 123]]]);

        $result = $customers->updateCustomer(123, ['name' => 'Updated Customer']);
        $this->assertEquals([['id' => 123]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Customers::patchCustomer
     */
    public function testPatchCustomer(): void
    {
        $customers = $this->getMockBuilder(Customers::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData', 'setPostFields'])
            ->getMock();

        $customers->expects($this->once())->method('setPostFields');
        $customers->expects($this->once())
            ->method('requestData')
            ->with('123', 'PATCH')
            ->willReturn(['results' => [['id' => 123]]]);

        $result = $customers->patchCustomer(123, ['name' => 'Patched Customer']);
        $this->assertEquals([['id' => 123]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Customers::getCustomerNameById
     */
    public function testGetCustomerNameById(): void
    {
        $customers = $this->getMockBuilder(Customers::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData'])
            ->getMock();

        $customers->expects($this->once())
            ->method('requestData')
            ->with('customername/123')
            ->willReturn(['results' => [['name' => 'Customer Name']]]);

        $result = $customers->getCustomerNameById(123);
        $this->assertEquals([['name' => 'Customer Name']], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Customers::getCustomerUsers
     */
    public function testGetCustomerUsers(): void
    {
        $customers = $this->getMockBuilder(Customers::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData'])
            ->getMock();

        $customers->expects($this->once())
            ->method('requestData')
            ->with('123/users')
            ->willReturn(['results' => [['id' => 1, 'login' => 'user1']]]);

        $result = $customers->getCustomerUsers(123);
        $this->assertEquals([['id' => 1, 'login' => 'user1']], $result['results']);
    }
}
