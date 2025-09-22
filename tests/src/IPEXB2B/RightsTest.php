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

use IPEXB2B\Rights;
use PHPUnit\Framework\TestCase;

/**
 * Tests for the Rights class.
 */
class RightsTest extends TestCase
{
    /**
     * @covers \IPEXB2B\Rights::getRights
     */
    public function testGetRights(): void
    {
        $rights = $this->getMockBuilder(Rights::class)
            ->onlyMethods(['requestData'])
            ->getMock();

        $rights->expects($this->once())
            ->method('requestData')
            ->willReturn(['results' => [['right' => 'provider_admin'], ['right' => 'provider_superadmin']]]);

        $result = $rights->getRights();
        $this->assertEquals([['right' => 'provider_admin'], ['right' => 'provider_superadmin']], $result['results']);
    }
}
