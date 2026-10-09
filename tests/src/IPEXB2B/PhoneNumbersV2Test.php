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

use IPEXB2B\PhoneNumbersV2;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(PhoneNumbersV2::class)]
class PhoneNumbersV2Test extends TestCase
{
    protected PhoneNumbersV2 $object;

    protected function setUp(): void
    {
        $this->object = new PhoneNumbersV2();
    }

    public function testGetSection(): void
    {
        $this->assertEquals('phone-numbers', $this->object->getSection());
    }

    public function testGetSectionURL(): void
    {
        $this->assertStringContainsString('/v2/phone-numbers', $this->object->getSectionURL());
    }
}
