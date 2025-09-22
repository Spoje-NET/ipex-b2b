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

use IPEXB2B\Requests;
use PHPUnit\Framework\TestCase;

/**
 * Tests for the Requests class.
 */
class RequestsTest extends TestCase
{
    /**
     * @covers \IPEXB2B\Requests::getRequests
     */
    public function testGetRequests(): void
    {
        $requests = $this->getMockBuilder(Requests::class)
            ->onlyMethods(['requestData', 'setUrlParams'])
            ->getMock();

        $requests->expects($this->once())->method('setUrlParams');
        $requests->expects($this->once())
            ->method('requestData')
            ->willReturn(['results' => [['id' => 1]]]);

        $result = $requests->getRequests();
        $this->assertEquals([['id' => 1]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Requests::getRequestById
     */
    public function testGetRequestById(): void
    {
        $requests = $this->getMockBuilder(Requests::class)
            ->onlyMethods(['requestData'])
            ->getMock();

        $requests->expects($this->once())
            ->method('requestData')
            ->with('123')
            ->willReturn(['results' => [['id' => 123]]]);

        $result = $requests->getRequestById(123);
        $this->assertEquals([['id' => 123]], $result['results']);
    }

    /**
     * @covers \IPEXB2B\Requests::deleteRequest
     */
    public function testDeleteRequest(): void
    {
        $requests = $this->getMockBuilder(Requests::class)
            ->onlyMethods(['requestData'])
            ->getMock();

        $requests->expects($this->once())
            ->method('requestData')
            ->with('123', 'DELETE')
            ->willReturn(['results' => [['id' => 123]]]);

        $result = $requests->deleteRequest(123);
        $this->assertEquals([['id' => 123]], $result['results']);
    }
}
