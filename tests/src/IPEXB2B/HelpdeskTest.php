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

use IPEXB2B\Helpdesk;
use PHPUnit\Framework\TestCase;

/**
 * Tests for the Helpdesk class.
 */
class HelpdeskTest extends TestCase
{
    /**
     * @covers \IPEXB2B\Helpdesk::getHelpdesk
     */
    public function testGetHelpdesk(): void
    {
        $helpdesk = $this->getMockBuilder(Helpdesk::class)
            ->onlyMethods(['requestData'])
            ->getMock();

        $helpdesk->expects($this->once())
            ->method('requestData')
            ->with('123')
            ->willReturn(['results' => [['id' => 123]]]);

        $result = $helpdesk->getHelpdesk(123);
        $this->assertEquals([['id' => 123]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Helpdesk::createHelpdesk
     */
    public function testCreateHelpdesk(): void
    {
        $helpdesk = $this->getMockBuilder(Helpdesk::class)
            ->onlyMethods(['requestData', 'setPostFields'])
            ->getMock();

        $helpdesk->expects($this->once())->method('setPostFields');
        $helpdesk->expects($this->once())
            ->method('requestData')
            ->with('', 'POST')
            ->willReturn(['results' => [['id' => 2]]]);

        $result = $helpdesk->createHelpdesk(['name' => 'test']);
        $this->assertEquals([['id' => 2]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Helpdesk::patchHelpdesk
     */
    public function testPatchHelpdesk(): void
    {
        $helpdesk = $this->getMockBuilder(Helpdesk::class)
            ->onlyMethods(['requestData', 'setPostFields'])
            ->getMock();

        $helpdesk->expects($this->once())->method('setPostFields');
        $helpdesk->expects($this->once())
            ->method('requestData')
            ->with('123', 'PATCH')
            ->willReturn(['results' => [['id' => 123]]]);

        $result = $helpdesk->patchHelpdesk(123, ['name' => 'updated']);
        $this->assertEquals([['id' => 123]], $result['results']);
    }
}
