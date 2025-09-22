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

use IPEXB2B\IctPriceList;
use PHPUnit\Framework\TestCase;

/**
 * Tests for the IctPriceList class.
 */
class IctPriceListTest extends TestCase
{
    /**
     * @covers \IPEXB2B\IctPriceList::getIctPriceLists
     */
    public function testGetIctPriceLists(): void
    {
        $ictPriceList = $this->getMockBuilder(IctPriceList::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData', 'setUrlParams'])
            ->getMock();

        $ictPriceList->expects($this->once())->method('setUrlParams');
        $ictPriceList->expects($this->once())
            ->method('requestData')
            ->willReturn(['results' => [['id' => 1]]]);

        $result = $ictPriceList->getIctPriceLists();
        $this->assertEquals([['id' => 1]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\IctPriceList::copyIctPriceList
     */
    public function testCopyIctPriceList(): void
    {
        $ictPriceList = $this->getMockBuilder(IctPriceList::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData', 'setPostFields'])
            ->getMock();

        $ictPriceList->expects($this->once())->method('setPostFields');
        $ictPriceList->expects($this->once())
            ->method('requestData')
            ->with('copy', 'POST')
            ->willReturn(['results' => [['id' => 2]]]);

        $result = $ictPriceList->copyIctPriceList(['priceListId' => 1, 'name' => 'new']);
        $this->assertEquals([['id' => 2]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\IctPriceList::getIctPriceList
     */
    public function testGetIctPriceList(): void
    {
        $ictPriceList = $this->getMockBuilder(IctPriceList::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData'])
            ->getMock();

        $ictPriceList->expects($this->once())
            ->method('requestData')
            ->with('123')
            ->willReturn(['results' => [['id' => 123]]]);

        $result = $ictPriceList->getIctPriceList(123);
        $this->assertEquals([['id' => 123]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\IctPriceList::patchIctPriceList
     */
    public function testPatchIctPriceList(): void
    {
        $ictPriceList = $this->getMockBuilder(IctPriceList::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData', 'setPostFields'])
            ->getMock();

        $ictPriceList->expects($this->once())->method('setPostFields');
        $ictPriceList->expects($this->once())
            ->method('requestData')
            ->with('123', 'PATCH')
            ->willReturn(['results' => [['id' => 123]]]);

        $result = $ictPriceList->patchIctPriceList(123, ['name' => 'updated']);
        $this->assertEquals([['id' => 123]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\IctPriceList::getIctPriceListItem
     */
    public function testGetIctPriceListItem(): void
    {
        $ictPriceList = $this->getMockBuilder(IctPriceList::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData'])
            ->getMock();

        $ictPriceList->expects($this->once())
            ->method('requestData')
            ->with('items/456')
            ->willReturn(['results' => [['id' => 456]]]);

        $result = $ictPriceList->getIctPriceListItem(456);
        $this->assertEquals([['id' => 456]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\IctPriceList::patchIctPriceListItem
     */
    public function testPatchIctPriceListItem(): void
    {
        $ictPriceList = $this->getMockBuilder(IctPriceList::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['requestData', 'setPostFields'])
            ->getMock();

        $ictPriceList->expects($this->once())->method('setPostFields');
        $ictPriceList->expects($this->once())
            ->method('requestData')
            ->with('items/456', 'PATCH')
            ->willReturn(['results' => [['id' => 456]]]);

        $result = $ictPriceList->patchIctPriceListItem(456, ['price' => 100]);
        $this->assertEquals([['id' => 456]], $result['results']);
    }
}
