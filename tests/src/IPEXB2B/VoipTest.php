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

use IPEXB2B\Voip;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Voip::class)]
class VoipTest extends TestCase
{
    protected Voip $object;

    protected function setUp(): void
    {
        $this->object = new Voip();
    }

    public function testGetSection(): void
    {
        $this->assertEquals('voip', $this->object->getSection());
    }

    public function testGetSectionURL(): void
    {
        $this->assertStringContainsString('/v1/voip', $this->object->getSectionURL());
    }
}
