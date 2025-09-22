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

use IPEXB2B\Internet;
use PHPUnit\Framework\TestCase;

/**
 * Tests for the Internet class.
 */
class InternetTest extends TestCase
{
    /**
     * @covers \IPEXB2B\Internet::getInternetTypes
     */
    public function testGetInternetTypes(): void
    {
        $internet = $this->getMockBuilder(Internet::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData'])
            ->getMock();

        $internet->expects($this->once())
            ->method('requestData')
            ->with('types')
            ->willReturn(['results' => [['id' => 1]]]);

        $result = $internet->getInternetTypes();
        $this->assertEquals([['id' => 1]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Internet::getInternet
     */
    public function testGetInternet(): void
    {
        $internet = $this->getMockBuilder(Internet::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData'])
            ->getMock();

        $internet->expects($this->once())
            ->method('requestData')
            ->with('123')
            ->willReturn(['results' => [['id' => 123]]]);

        $result = $internet->getInternet(123);
        $this->assertEquals([['id' => 123]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Internet::createInternet
     */
    public function testCreateInternet(): void
    {
        $internet = $this->getMockBuilder(Internet::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData', 'setPostFields'])
            ->getMock();

        $internet->expects($this->once())->method('setPostFields');
        $internet->expects($this->once())
            ->method('requestData')
            ->with('', 'POST')
            ->willReturn(['results' => [['id' => 2]]]);

        $result = $internet->createInternet(['name' => 'test']);
        $this->assertEquals([['id' => 2]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Internet::patchInternet
     */
    public function testPatchInternet(): void
    {
        $internet = $this->getMockBuilder(Internet::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData', 'setPostFields'])
            ->getMock();

        $internet->expects($this->once())->method('setPostFields');
        $internet->expects($this->once())
            ->method('requestData')
            ->with('123', 'PATCH')
            ->willReturn(['results' => [['id' => 123]]]);

        $result = $internet->patchInternet(123, ['name' => 'updated']);
        $this->assertEquals([['id' => 123]], $result['results']);
    }
}
