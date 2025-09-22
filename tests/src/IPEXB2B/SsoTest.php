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

use IPEXB2B\Sso;
use PHPUnit\Framework\TestCase;

/**
 * Tests for the Sso class.
 */
class SsoTest extends TestCase
{
    /**
     * @covers \IPEXB2B\Sso::getTicketingToken
     */
    public function testGetTicketingToken(): void
    {
        $sso = $this->getMockBuilder(Sso::class)
            ->onlyMethods(['requestData'])
            ->getMock();

        $sso->expects($this->once())
            ->method('requestData')
            ->with('ticketing/token')
            ->willReturn(['results' => [['token' => 'test-token']]]);

        $result = $sso->getTicketingToken();
        $this->assertEquals([['token' => 'test-token']], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Sso::login
     */
    public function testLogin(): void
    {
        $sso = $this->getMockBuilder(Sso::class)
            ->onlyMethods(['requestData', 'setPostFields'])
            ->getMock();

        $sso->expects($this->once())->method('setPostFields');
        $sso->expects($this->once())
            ->method('requestData')
            ->with('login', 'POST')
            ->willReturn(['results' => [['token' => 'login-token']]]);

        $result = $sso->login(['username' => 'test', 'password' => 'test']);
        $this->assertEquals([['token' => 'login-token']], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Sso::refresh
     */
    public function testRefresh(): void
    {
        $sso = $this->getMockBuilder(Sso::class)
            ->onlyMethods(['requestData'])
            ->getMock();

        $sso->expects($this->once())
            ->method('requestData')
            ->with('refresh', 'POST')
            ->willReturn(['results' => [['token' => 'refresh-token']]]);

        $result = $sso->refresh();
        $this->assertEquals([['token' => 'refresh-token']], $result['results']);
    }
}
