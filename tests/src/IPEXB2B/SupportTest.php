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

use IPEXB2B\Support;
use PHPUnit\Framework\TestCase;

/**
 * Tests for the Support class.
 */
class SupportTest extends TestCase
{
    /**
     * @covers \IPEXB2B\Support::getSupport
     */
    public function testGetSupport(): void
    {
        $support = $this->getMockBuilder(Support::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData'])
            ->getMock();

        $support->expects($this->once())
            ->method('requestData')
            ->with('123')
            ->willReturn(['results' => [['id' => 123]]]);

        $result = $support->getSupport(123);
        $this->assertEquals([['id' => 123]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Support::createSupport
     */
    public function testCreateSupport(): void
    {
        $support = $this->getMockBuilder(Support::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData', 'setPostFields'])
            ->getMock();

        $support->expects($this->once())->method('setPostFields');
        $support->expects($this->once())
            ->method('requestData')
            ->with('', 'POST')
            ->willReturn(['results' => [['id' => 2]]]);

        $result = $support->createSupport(['name' => 'test']);
        $this->assertEquals([['id' => 2]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Support::patchSupport
     */
    public function testPatchSupport(): void
    {
        $support = $this->getMockBuilder(Support::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData', 'setPostFields'])
            ->getMock();

        $support->expects($this->once())->method('setPostFields');
        $support->expects($this->once())
            ->method('requestData')
            ->with('123', 'PATCH')
            ->willReturn(['results' => [['id' => 123]]]);

        $result = $support->patchSupport(123, ['name' => 'updated']);
        $this->assertEquals([['id' => 123]], $result['results']);
    }
}
