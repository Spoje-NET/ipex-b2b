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

use IPEXB2B\Users;
use PHPUnit\Framework\TestCase;

/**
 * Tests for the Users class.
 */
class UsersTest extends TestCase
{
    /**
     * @covers \IPEXB2B\Users::getMe
     */
    public function testGetMe(): void
    {
        $users = $this->getMockBuilder(Users::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData', 'setUrlParams'])
            ->getMock();

        $users->expects($this->once())->method('setUrlParams');
        $users->expects($this->once())
            ->method('requestData')
            ->with('me')
            ->willReturn(['results' => [['id' => 1]]]);

        $result = $users->getMe();
        $this->assertEquals([['id' => 1]], $result['results']);
    }
}
