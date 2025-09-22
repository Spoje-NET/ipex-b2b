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

use IPEXB2B\Pbx;
use PHPUnit\Framework\TestCase;

/**
 * Tests for the Pbx class.
 */
class PbxTest extends TestCase
{
    /**
     * @covers \IPEXB2B\Pbx::getPbxInfo
     */
    public function testGetPbxInfo(): void
    {
        $pbx = $this->getMockBuilder(Pbx::class)
            ->onlyMethods(['requestData', 'setUrlParams'])
            ->getMock();

        $pbx->expects($this->once())->method('setUrlParams');
        $pbx->expects($this->once())
            ->method('requestData')
            ->willReturn(['results' => [['id' => 1]]]);

        $result = $pbx->getPbxInfo();
        $this->assertEquals([['id' => 1]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Pbx::createPbx
     */
    public function testCreatePbx(): void
    {
        $pbx = $this->getMockBuilder(Pbx::class)
            ->onlyMethods(['requestData', 'setPostFields'])
            ->getMock();

        $pbx->expects($this->once())->method('setPostFields');
        $pbx->expects($this->once())
            ->method('requestData')
            ->with('', 'POST')
            ->willReturn(['results' => [['id' => 2]]]);

        $result = $pbx->createPbx(['name' => 'test']);
        $this->assertEquals([['id' => 2]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Pbx::deletePbx
     */
    public function testDeletePbx(): void
    {
        $pbx = $this->getMockBuilder(Pbx::class)
            ->onlyMethods(['requestData'])
            ->getMock();

        $pbx->expects($this->once())
            ->method('requestData')
            ->with('123', 'DELETE')
            ->willReturn(['results' => [['id' => 123]]]);

        $result = $pbx->deletePbx(123);
        $this->assertEquals([['id' => 123]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Pbx::patchPbx
     */
    public function testPatchPbx(): void
    {
        $pbx = $this->getMockBuilder(Pbx::class)
            ->onlyMethods(['requestData', 'setPostFields'])
            ->getMock();

        $pbx->expects($this->once())->method('setPostFields');
        $pbx->expects($this->once())
            ->method('requestData')
            ->with('123', 'PATCH')
            ->willReturn(['results' => [['id' => 123]]]);

        $result = $pbx->patchPbx(123, ['name' => 'updated']);
        $this->assertEquals([['id' => 123]], $result['results']);
    }
}
