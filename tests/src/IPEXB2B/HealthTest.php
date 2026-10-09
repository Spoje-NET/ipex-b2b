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

use IPEXB2B\Health;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Health::class)]
class HealthTest extends TestCase
{
    protected Health $object;

    protected function setUp(): void
    {
        $this->object = new Health();
    }

    public function testGetSection(): void
    {
        $this->assertEquals('health', $this->object->getSection());
    }

    public function testGetSectionURL(): void
    {
        $this->assertStringEndsWith('/health', $this->object->getSectionURL());
    }
}
