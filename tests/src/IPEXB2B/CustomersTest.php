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
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Customers::class)]
class CustomersTest extends TestCase
{
    protected Customers $object;

    protected function setUp(): void
    {
        $this->object = new Customers();
    }

    public function testGetSection(): void
    {
        $this->assertEquals('customers', $this->object->getSection());
    }

    public function testGetSectionURL(): void
    {
        $this->assertStringContainsString('/v1/customers', $this->object->getSectionURL());
    }
}
