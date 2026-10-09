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

use IPEXB2B\FreeUnits;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(FreeUnits::class)]
class FreeUnitsTest extends TestCase
{
    protected FreeUnits $object;

    protected function setUp(): void
    {
        $this->object = new FreeUnits();
    }

    public function testGetSection(): void
    {
        $this->assertEquals('freeUnits', $this->object->getSection());
    }

    public function testGetSectionURL(): void
    {
        $this->assertStringContainsString('/v1/freeUnits', $this->object->getSectionURL());
    }
}
