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

use IPEXB2B\Providers;
use PHPUnit\Framework\TestCase;

/**
 * Tests for the Providers class.
 */
class ProvidersTest extends TestCase
{
    /**
     * @covers \IPEXB2B\Providers::getSettings
     */
    public function testGetSettings(): void
    {
        $providers = $this->getMockBuilder(Providers::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData'])
            ->getMock();

        $providers->expects($this->once())
            ->method('requestData')
            ->with('settings')
            ->willReturn(['results' => [['contactEmail' => 'test@example.com']]]);

        $result = $providers->getSettings();
        $this->assertEquals([['contactEmail' => 'test@example.com']], $result['results']);
    }
}
