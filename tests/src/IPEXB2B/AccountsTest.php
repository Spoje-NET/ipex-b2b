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

use IPEXB2B\Accounts;
use PHPUnit\Framework\TestCase;

/**
 * Tests for the Accounts class.
 */
class AccountsTest extends TestCase
{
    /**
     * @covers \IPEXB2B\Accounts::getAccount
     */
    public function testGetAccount(): void
    {
        $accounts = $this->getMockBuilder(Accounts::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData'])
            ->getMock();

        $accounts->expects($this->once())
            ->method('requestData')
            ->with('testuser')
            ->willReturn(['results' => [['username' => 'testuser']]]);

        $result = $accounts->getAccount('testuser');
        $this->assertEquals([['username' => 'testuser']], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Accounts::updateAccount
     */
    public function testUpdateAccount(): void
    {
        $accounts = $this->getMockBuilder(Accounts::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData', 'setPostFields'])
            ->getMock();

        $accounts->expects($this->once())->method('setPostFields');
        $accounts->expects($this->once())
            ->method('requestData')
            ->with('testuser', 'PUT')
            ->willReturn(['results' => [['username' => 'testuser']]]);

        $result = $accounts->updateAccount('testuser', ['name' => 'updated']);
        $this->assertEquals([['username' => 'testuser']], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Accounts::deleteAccount
     */
    public function testDeleteAccount(): void
    {
        $accounts = $this->getMockBuilder(Accounts::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData'])
            ->getMock();

        $accounts->expects($this->once())
            ->method('requestData')
            ->with('testuser', 'DELETE')
            ->willReturn(['results' => [['username' => 'testuser']]]);

        $result = $accounts->deleteAccount('testuser');
        $this->assertEquals([['username' => 'testuser']], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Accounts::createAccount
     */
    public function testCreateAccount(): void
    {
        $accounts = $this->getMockBuilder(Accounts::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData', 'setPostFields'])
            ->getMock();

        $accounts->expects($this->once())->method('setPostFields');
        $accounts->expects($this->once())
            ->method('requestData')
            ->with('', 'POST')
            ->willReturn(['results' => [['username' => 'newuser']]]);

        $result = $accounts->createAccount(['username' => 'newuser']);
        $this->assertEquals([['username' => 'newuser']], $result['results']);
    }
}
